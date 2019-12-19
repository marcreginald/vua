<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model', 'dash');
    }
    
    public function index()
    {
        
        if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Dashboard (儀表板)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Dashboard (儀表板) <small> List of VUA transactions summary etc. </small></h1> <hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
			setcookie('active', '#dashboard', time() + (86400 * 30), "/");

			$this->load->view('dashboard_v', $data);
		}
        
    }
    
    /* getting the counter for the draft */
    public function getdraft()
    {
        $return = new stdClass();
        $q = $this->dash->get_drafttransac();
        $return->counter = $q;
        return_json($return, FALSE);
    }
    
    /* getting the counter for the pendings */
    public function getpending()
    {
        
        $return = new stdClass();
        $q = $this->dash->get_pendingtransac();
        $return->counter = $q;
        return_json($return, FALSE);
    }
    
    /* getting the counter for the verified */
    public function getverified()
    {
        $return = new stdClass();
        $q = $this->dash->get_verifiedtransac();
        $return->counter = $q;
        return_json($return, FALSE);
    }
    
    /* getting the counter for the approved */
    public function getapproved()
    {
        $return = new stdClass();
        $q = $this->dash->get_approvedtransac();
        $return->counter = $q;
        return_json($return, FALSE);
    }
    
    /* transaction remarks */
    public function getrecentact()
    {
        $res = $this->dash->transac_rmk();
        print $res;
    }
    
    /* getting all the VUA active users */
    public function getactiveusers()
    {
        
        $res = $this->dash->vua_users();
        print $res;
    }
}
