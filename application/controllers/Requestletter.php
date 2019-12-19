<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* The generated Request letter of the manager good as viewing purpose on the generated Request Letter */
class Requestletter extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('requestletter_model', 'rq');
	}
    
	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Request Letters (請求信)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Request Letters (請求信)<small>This are the generated letters </small></h1><hr>
EOD;
			$data['user_dat'] = array(
				'name'   => get_cookie('fullname'),
				'pic'    => base_url(get_cookie('profile_pic')),
				'noti'   => 1, // change these to 0
				'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        //requestletter
	        setcookie('active', '#requestletter', time() + (86400 * 30), "/");

			$this->load->view('pages/request_letterlogs', $data);
		}
	}
    
    /* get request letter logs */
    public function getrqllogs($from, $to)
    {
        $from = $this->vua_lib->isodate($from);
        $to   = $this->vua_lib->isodate($to);
        $result = $this->rq->get_rqlletter($from, $to);
        print $result;
    }
}
