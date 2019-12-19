<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
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
	        $data['title'] = "User Maintenance (用戶維護)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> User Maintenance (用戶維護)<small></small></h1><hr>
EOD;

			$data['breadcrumb'] = <<<EOD
				<ol class="breadcrumb pull-right">
					<li><a href="javascript:;" style="display:none;">Home</a></li>
					<li class="active">Home</li>
				</ol>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
			setcookie('active', '#users', time() + (86400 * 30), "/");
	        
            $this->load->view('pages/usersyst_v', $data);
    	}

	}

    /* dt payload for the user */
    public function dtusers()
    {
        
        $res = $this->usr->dt_userlist();
        print $res;
    }
    
    /* saving the new user */
    public function savenewuser()
    {
        
       $createdBy = get_cookie('user_id');
        $res = $this->usr->create_user($_POST, $createdBy);   
        return_json((boolean)$res, TRUE);
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
