<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Sent Trasaction Viewer Controller */
class Senttransacview extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function index($transId)
	{
        if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "View";
			$data['header'] = <<<EOD
				<h1 class="page-header"> View Details <small>Transaction Information</small></h1>
EOD;

			$data['breadcrumb'] = <<<EOD
				<ol class="breadcrumb pull-right">
					<li><a href="javascript:;">Inbox</a></li>
					<li class="active">Approval</li>
				</ol>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        $data['trans_type'] = '<h4> <span class="fa fa-bell"> </span> Requesting to verify Transaction <u><strong>BTCH-00902!</strong></u></h4>'; 
	        
			$this->load->view('pages/viewsent_transac_v', $data);
		}
	}
}
