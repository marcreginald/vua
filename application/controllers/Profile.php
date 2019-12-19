
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('user_model', 'usr');
	}
    
	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "User Profile (用戶資料)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> User Profile (用戶資料)<small></small></h1><hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id'),
					'firstname' => get_cookie('f_name'), 
					'lastname' 	=> get_cookie('l_name'), 
					'email' 	=> get_cookie('email'), 
			);

	        $data['acc_type'] = get_cookie('user_type');
			setcookie('active', '#profile', time() + (86400 * 30), "/");
	
            $this->load->view('pages/profile_v', $data);
		}

	}

    /* dt payload for the user */
    public function dtusers()
    {
        
        $res = $this->usr->dt_userlist();
        print $res;
    }
    
    /* getting s specific user info */
    public function getuserinfo($userId)
    {
        
        $res = $this->usr->get_userinfo($userId);
        return_json($res, FALSE);
    }
    
    /* updating the existing user info*/
    public function updateuserinfo()
    {
        
        $q = $this->usr->update_user($_POST);
        return_json((boolean)$q, TRUE);
    }
    
}
