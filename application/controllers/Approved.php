<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approved extends CI_Controller {

	/* magic constructor */
	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model', 'usr');
        $this->load->model('requestletter_model', 'rq');
        $this->load->model('visaview_model', 'vv');
	}

	public function index()
	{
        if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Approved";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Approved Visa (批准的簽證)<small> List of Approved VISA </small></h1><hr>
EOD;
			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#visa', time() + (86400 * 30), "/");
            setcookie('active_two', '#approved', time() + (86400 * 30), "/");
            // pweding may active_two :) then set mo so id ko li :D bae na muna kadto
	        
			$this->load->view('pages/approved_v', $data);
		}
    }
    
    /* getting the */
    public function getapprovedtbl($from,$to)
    {
        $from = $this->vua_lib->isodate($from);
        $to   = $this->vua_lib->isodate($to);
        $res = $this->vv->get_tblapproved($from, $to);   
        print $res;
    }

}

/* End of file Approved.php */
/* Location: ./application/controllers/Approved.php */
