<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* AGENT DRAFTED TRANSACTIONS */
class Draftagent extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
    }
    
	public function index()
	{
        if(!check_session()){
            redirect('login');
        }
        else
        {
            $data['title'] = "Draft (草案)";
    		$data['header'] = <<<EOD
    			<h1 class="page-header"> Draft (草案)<small> This are the drafts </small></h1><hr>
EOD;

    		$data['user_dat'] = array(
    				'name'   => get_cookie('fullname'),
    				'pic'    => base_url(get_cookie('profile_pic')),
    				'noti'   => 1, // change these to 0
    				'userid' => get_cookie('user_id')
    		);

            $data['acc_type'] = get_cookie('user_type');
            //draftagent
            setcookie('active', '#draftagent', time() + (86400 * 30), "/");
            
    		$this->load->view('pages/agent_draft_v', $data);
        }
	}
    
    # DT PAYLOAD FOR VIEWING AGENT DRAFTED TRANSACTIONS
    public function dtagentdrafted()
    {
        $userId = get_cookie('user_id');
        $dt     = $this->vt->agent_draftedtransactions($userId); // where trans_status => DRAFT BY THE SPECIFIC USER
        print $dt;
    }
    
    # DISCARDING ALL THE USER_ DRAFTED VISA TRANSACTION
    public function disgardagentdrafttrans()
    {
        $userId        = get_cookie('user_id');
        $q = $this->vt->discarduser_draft($userId);  
        return_json($q, TRUE);
    }
    
    #DISCARDING A CERTAIN TRANSACTION
    public function discardtrans()
    {
        
        $transNumArr = (isset($_POST['selected']) ? $_POST['selected'] : []);
        $cnt = count($transNumArr);
        if($cnt != 0){
            
            $status   = $this->input->post('trans_status');
            $rmkBy    = get_cookie('user_id');

            $isDeleted = FALSE;
            for($i=0; $i<$cnt; $i++){
                $isDeleted = $this->vt->change_transstatus($transNumArr[$i], $status, $rmkBy);
            }
            return_json($isDeleted, TRUE);
            
        }else{
            // return_json(FALSE, TRUE);
            $this->disgardagentdrafttrans();
        }
    }
    
    # OUT PUT THE ROW FOR THE SENDING BATCH NEEDLE (all) (userId)
    public function getagentalltransac()
    {
        
        $user_id = get_cookie('user_id');
        
        $result = $this->vt->all_draftedagent($user_id);

        $trList = "";
        $i=0;
        
        foreach($result as $res){
            
            $num = ++$i;
            $tr = <<<EOD
                    <tr id="trans" data-crnttransnum="$res->trans_no">
                        <td> $num </td>
                        <td> $res->fullname </td>
                        <td> $res->gender </td>
                        <td> $res->birthdate </td>
                        <td style="text-transform:uppercase;"> $res->passport </td>
                        <td> <button class="btn btn-icon btn-sm btn-danger" id="btn-remove">X</button> </td>
                    </tr>
EOD;
            $trList .= $tr;
        }
        
        print $trList;
            
    }
    
    # OUTPUT ONLY THE SELECTED GET ARRAY INDEXES
    public function getselectedtransac()
    {
        
        $selected = $_POST['selected'];
        $trList = "";
        $ctr=0;
        
        for($i=0, $ln=count($selected); $i < $ln; $i++){
            
            $num = ++$ctr;
            // select the data then create a tr then append it to the trRows then print it
            $res = $this->vt->get_transdata($selected[$i]);
            $fullName = ucfirst($res->va_fname).' '.ucfirst($res->va_lname);
            
            $tr = <<<EOD
            <tr id="trans" data-crnttransnum="$res->trans_no">
                <td> $num </td>
                <td > $fullName </td>
                <td> $res->va_gender </td>
                <td> $res->va_dob </td>
                <td style="text-transform:uppercase;"> $res->va_passportnum </td>
                <td> <button class="btn btn-icon btn-sm btn-danger" id="btn-remove">X</button> </td>
            </tr>
EOD;
            $trList .= $tr;
        }
         print $trList; // printing the tr
    }
    
}
