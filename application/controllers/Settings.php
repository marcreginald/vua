<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Settings";
			$data['header'] = <<<EOD
				<h1 class="page-header" style="font-size: 27px;"> Settings <small> VUA System Setting </small></h1> <hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
			setcookie('active', '#settings', time() + (86400 * 30), "/");

			$this->load->view('pages/setting_v', $data);
		}
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */