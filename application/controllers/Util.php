<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
    controller class to abstract the following transaction process 
    
    0. Approving Visa Transaction
    1. Junking
    3. Deleting a visa transaction 
    4. Regrouping VISA Transaction
*/
class Util extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('visatransaction_model', 'vt'); //Visa Transaction
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('batchrequest_model', 'btrq');
	}

    /* approving/verifying a certain visa transaction or a batched of it */
    public function approving()
    {
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $transNum = $this->input->post('transnum');
            $verifierId = get_cookie('user_id');
            
            $Q = $this->vt->verified_transac($transNum, $verifierId);
        
             if(!$Q){
                 return_json(FALSE, TRUE);
             }else{
                 return_json(TRUE, TRUE);
             }
        }
    }
    
    /* junking a specific transaction or a batched or it */
    public function junking()
    {
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
         
            $transNum = $this->input->post('transnum');
            $junkBy   = get_cookie('user_id');
        
            $Q = $this->vt->junking_transac($transNum, $junkBy);
            return_json((boolean)$Q, TRUE);
        }
    }
    
    /* formatted select2 for the request letter (to) */
    public function getcommisionerlist()
    {
        
        $returnSlect = new stdClass();
        
        $this->db->select(['boiprofile_id as id', 'current_commisioner as text']);
        $slct2 = $this->db->get(BOI);
        
        $result = $slct2->result();
        
        if($slct2->num_rows() === 0){
            return_json(new stdClass(), FALSE);
        }else{
            $returnSlect->data = $result;
            return_json($returnSlect, FALSE);
        }
    }
    
    /* formatted select2 for the assignatory list */
    public function getassignatorylist()
    {
        
        $returnSelect = new stdClass();
        $this->db->select(['assignatory_id as id', 'fullname as text']);
        $res = $this->db->get(ASSIG)->result();
        
        if(count($res) === 0){
            return_json(new stdClass(), FALSE);
        }else{
            $returnSelect->data = $res;
            return_json($returnSelect, FALSE);
        }
    }
    
    /* batch of the application (tr of tbody)*/
    public function getbatchapplicationlist($batchId)
    {
        $result = $this->bt->get_composeditlistapplicant($batchId);

        $trList = "";
        $i      =0;
        
        foreach($result as $row){
            
            $num  = ++$i;
            $fName= $row->fname.' &nbsp; '.$row->lname;
            $passport = strtoupper($row->passportnum);
            $tr = <<<EOD
                <tr>
                   <td>$num</td>
                   <td>$fName</td>
                   <td>$row->gender</td>
                   <td>$row->dob</td>
                   <td>$passport</td>
                   <td>$row->trans_stat</td>
                </tr>
EOD;
            $trList .= $tr;
        }
        
        print $trList;
    }
    
    /* function to select all batch neglecting the passed batchNo */
    public function getpossiblegrps()
    {
    
       $slcted = new stdClass();
       $this->db->distinct();
       $this->db->select(['batch_no as id', 'batch_no as text']);
       $q = $this->db->get_where(VISA_TRANSAC, array('trans_status =' => 'VERIFIED'));
       $result = $q->result();
       
       if($q->num_rows() === 0){
           return_json(new stdClass(), FALSE);
       }else{
           $slcted->data = $result;
           return_json($slcted, FALSE);
       }    
    }
    
    /*getting the sidebar visa transaction formatted (admin type)*/
    public function admingetbatchrql()
    {
        // test if first in the test controller
        $res = $this->btrq->get_allbatchrequest();
        print $res;
    }
    
    /* getting the sidebar (agent type) */
    public function agentbatchrql()
    {
        // test if first in the test controller
        $agentId = get_cookie('user_id');
        $res = $this->btrq->agentbase_batchrql($agentId);
        print $res;
    }
    
}

/* End of file Notfound.php */
/* Location: ./application/controllers/Notfound.php */
