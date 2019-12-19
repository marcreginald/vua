<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* viewing the batch transaction / composing the request letter */
class Compose extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('requestletter_model', 'rq');
	}
	
    /* index */
	public function index($batchId)
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
			#PAGE & USER DATA
	        $data['title']  = "Compose";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Compose (撰寫)<small> Create request letter </small></h1><hr>
EOD;

			$data['user_dat'] = array(
				'name'   => get_cookie('fullname'),
				'pic'    => base_url(get_cookie('profile_pic')),
				'noti'   => 1, // change these to 0
				'userid' => get_cookie('user_id')
			);

	        $data['acc_type']  = get_cookie('user_type');
	        setcookie('active', '#batchrecords', time() + (86400 * 30), "/");
            
            if($this->bt->isbt_exist($batchId)){

            	$BatchDat = $this->bt->get_batchtransac($batchId);
	             if(!is_null($BatchDat)){
	                $data['travel_info'] = array(
	                     'arrival'      => $BatchDat[0]->arrival,
	                     'airline_port' => $BatchDat[0]->via,
	                     'poe'          => $BatchDat[0]->poe, 
	                     'flight_num'   => $BatchDat[0]->fov,
	                );
	                 
	                $this->load->view('pages/mgr_compose_v', $data);
	             }
            }
            else{
            	redirect('notfound');
            } 

		}
        
	}
    
    /* saving the request letter */
    public function saverq()
    {
        $letterDate = $_POST['letter_date'];
        unset($_POST['letter_date']);
        $newLetterDate = $this->vua_lib->isodate($letterDate);
        $data = array(
            'batch_no'      => $this->input->post('batch_no'), 
            'rq_to'         => $this->input->post('rq_to'),
            'letter_date'   => $newLetterDate, 
            'assignatory'   => $this->input->post('assignatory'), 
            'rq_status'     => 'saved', 
            'created_by'    => get_cookie('user_id')
        );
        $q = $this->rq->rq_draft($data);
        return_json($q, TRUE);
        
        /* 'batch_no', 'to', 'letter_date', 'assignatory', 'rq_status', 'created_by' */
    }
}
