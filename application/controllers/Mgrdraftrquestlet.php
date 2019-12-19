<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* MANAGER DRAFTED REQUEST LETTER */
class Mgrdraftrquestlet extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('requestletter_model', 'rq');
	}
    
    /* index */
	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Request Letters (請求信)";
			$data['header'] = <<<EOD
				<h1 class="page-header">Request Letters (請求信)<small> This are the saved request letter </small></h1><hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        //mgrdraftrquestlet
	        setcookie('active', '#mgrdraftrquestlet', time() + (86400 * 30), "/");
	        
			$this->load->view('pages/mgr_draft_request_letter', $data);
		}
	}
    
    /* dt draft_request letter */
    public function draftrql()
    {
        $dt = $this->rq->dt_rqdraft();
        print $dt;        
    }
    
    /* saving the generationof batch_transaction */
    public function savegeneration()
    {
        $rqlid   = $this->input->post('rqlid');
        $batchNum= $this->input->post('batchnum');
        
        $Q = $this->rq->savegenerated_rql($rqlid, $batchNum);
        return_json($Q, FALSE);
    }
    
    /* deleting the save request letter */
    public function delallrql()
    {
        $res = $this->rq->del_allrqldraft();
        return_json((boolean)$res, TRUE);
    }
    
    /* passing a selected rqlidArr to be deleted */
    public function selectedrql()
    {
        $selected = $_POST['selectedrql'];
        $return   = TRUE;
        
        if(count($selected) === 0){
            return_json(FALSE, TRUE);
        }else{
            
            for($i=0, $ln=count($selected); $i<$ln; $i++){
                $return &= $this->rq->del_rqldraft($selected[$i]);
            }
            
            return_json((boolean)$return, TRUE);
        }    
    }
    
}
