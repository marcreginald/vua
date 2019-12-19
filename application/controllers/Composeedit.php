<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* editing of the composed request leter Composeedit */
class Composeedit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('requestletter_model', 'rq');
	}
	
    /* index */
	public function index($rqlId)
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{

			#PAGE & USER DATA
	        $data['title'] = "Request letter (請求信件號碼)".$rqlId;
			$data['header'] = <<<EOD
				<h1 class="page-header"> Request Letter (請求信件號碼) $rqlId <small> Update request letter </small></h1><hr>
EOD;

			$data['user_dat'] = array(
				'name'   => get_cookie('fullname'),
				'pic'    => base_url(get_cookie('profile_pic')),
				'noti'   => 1, // change these to 0
				'userid' => get_cookie('user_id')
			);

	        $data['acc_type']  = get_cookie('user_type');
	        setcookie('active', '#mgrdraftrquestlet', time() + (86400 * 30), "/");
            $RequestDat = $this->rq->get_rqldraft($rqlId); // combined these method to the request letter
            
            if(!is_null($RequestDat)){
                $batchId  = $RequestDat->batch_no;
                $BatchDat = $this->bt->get_pdfbatchtransac($batchId);
                
                $data['travel_info'] = array(
                     'arrival'       => $BatchDat[0]->arrival,
                     'airline_port'  => $BatchDat[0]->via,
                     'poe'           => $BatchDat[0]->poe, 
                     'flight_num'    => $BatchDat[0]->fov,
                );
                $data['to']          = $RequestDat->rq_to;
                $data['letter_date'] = $this->vua_lib->to_datetimepicker($RequestDat->letter_date);
                $data['signatory']   = $RequestDat->assignatory;
                $data['batch_no']    = $batchId;
                $data['rqlid']       = $rqlId;
                $data['attached_eticket'] = $BatchDat[0]->attached_eticket;
                
                 $this->load->view('pages/mgr_compose_edit', $data);
            }
		}
        
	}
    
    /* go to the util to the basic util to be found */
    public function updaterqldraft()
    {
        
        $data = array(
            'rq_to'      => $this->input->post('rq_to'),
            'letter_date'=> $this->vua_lib->isodate($this->input->post('letter_date')),
            'assignatory'=> $this->input->post('assignatory')
        );
        $rqlId = $this->input->post('rql_id');
        $Q = $this->rq->update_rqdraft($data, $rqlId);
        return_json($Q, TRUE);
        
    }
}
