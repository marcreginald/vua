<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'usr');
    }
    
    private function removecookies()
    {
        $this->session->sess_destroy(); // deleting the session
        delete_cookie('user_id');
        delete_cookie('user_email');
        delete_cookie('user_status');
        delete_cookie('user_type');
        delete_cookie('user_lname'); 
        delete_cookie('user_fname'); 
        delete_cookie('fullname');
        delete_cookie('active');
        delete_cookie('profile_pic');
    }
    
	public function index()
	{
        $this->removecookies();
        $data['title'] = "Login";
        $this->load->view('login', $data);
        // $this->output->enable_profiler(TRUE);
  }
    
  /* VALIDATING THE INPUTED USER CREDENTIALS */
  public function validate()
  {
      $email = $this->input->post('user_email', TRUE);
      $pass  = $this->input->post('user_pass', TRUE);
      
      $Q = $this->usr->validate($email, $pass);
    
      if(is_null($Q)){
         return_json(FALSE,TRUE);
      }else{
         // set cookies and file session here 
         $this->session->set_userdata('userdata', $Q);
         setcookie('profile_pic', $Q->user_profilepath, time() + (86400 * 30), "/");
         setcookie('user_id',     $Q->user_id, time() + (86400 * 30), "/");
         setcookie('user_email',  $Q->user_email, time() + (86400 * 30), "/");
         setcookie('user_status', $Q->user_status, time() + (86400 * 30), "/");
         setcookie('user_type',   $Q->user_type, time() + (86400 * 30), "/");
         setcookie('user_lname',  $Q->user_lname, time() + (86400 * 30), "/");
         setcookie('user_fname',  $Q->user_fname, time() + (86400 * 30), "/");
         setcookie('fullname',    $Q->user_fname.' '.$Q->user_lname, time() + (86400 * 30), "/");
         return_json(TRUE, TRUE);
      }
         
  }
  
}
