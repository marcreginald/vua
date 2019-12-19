<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sent extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model', 'usr');
        $this->load->model('twobatchvt_model', 'tbt');
	}
    
	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Sent (發送)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Sent (發送) <small>This are your batch transaction sent for approval</small></h1><hr>
EOD;
			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#sent', time() + (86400 * 30), "/");
	        
			$this->load->view('pages/agent_sent_v', $data);
            // $this->output->enable_profiler(TRUE);
            
		}
	}
    
    /* (dt) The agent sended visa transactions (controller up and runnning)*/
    public function usersentlist()
    {
        $userId = get_cookie('user_id');
        $dtSent = $this->usr->user_sentbacthview($userId);
         print $dtSent; 
        // die_r($dtSent);
    }
    
    public function agentbatchtransac($batchId)
    {
        //batch_travelinfo
        $res = $this->tbt->batch_travelinfo($batchId);
        return_json($res, FALSE);
    }
    
}
