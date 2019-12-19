<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inprocess extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'usr');
        $this->load->model('requestletter_model', 'rq');
    }
    
	public function index()
	{
        if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "In-Process (在進程)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> In-Process (在進程)<small> waiting for Burue of Immigration Approval</small></h1><hr>
EOD;
			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#visa', time() + (86400 * 30), "/");
            setcookie('active_two', '#inprocess', time() + (86400 * 30), "/");
            // pweding may active_two :) then set mo so id ko li :D bae na muna kadto
	        
			$this->load->view('pages/inprocess_v', $data);
		}
    }
    
    /* getting the datatable for inprocess visa transaction waiting for the approved stamppe request letter*/
    public function getinprocess()
    {
        $res = $this->rq->dt_inprocess();
        print $res;
    }
    
}
