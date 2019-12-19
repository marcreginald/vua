<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notfound extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        /*
            kaya nag error so sa file not found upon loading sa resources ta na dedestroy adi sadi ehh..
            not found so session and so cookie
        */
		/*$this->session->sess_destroy();
		delete_cookie('user_id');
        delete_cookie('user_email');
        delete_cookie('user_lname');
        delete_cookie('user_fname');
        delete_cookie('user_branch'); 
        delete_cookie('user_type'); 
        delete_cookie('fullname'); 
        delete_cookie('profilepic'); 
        delete_cookie('active');*/
		$this->load->view('my_not_found');
	}

}

/* End of file Notfound.php */
/* Location: ./application/controllers/Notfound.php */
