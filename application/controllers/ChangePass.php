<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChangePass extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'usr');
	}

	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Change Password";
			$data['header'] = <<<EOD
				<h1 class="page-header" style="font-size: 27px;"> Change Password (更改密碼)</h1> <hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
			setcookie('active', '#changepass', time() + (86400 * 30), "/");

			$this->load->view('pages/change_pass_v', $data);
		}
	}
		public function updatepass(){
			
		}
	}
		
	
	

/* End of file ChangePass.php */
/* Location: ./application/controllers/ChangePass.php */