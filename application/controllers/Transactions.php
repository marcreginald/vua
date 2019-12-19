<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* */
class Transactions extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('twobatchvt_model', 'tbt');
        $this->load->model('transactions_model', 'tm');
    }
    
    
	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Transactions (交易)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Transactions (交易)<small> This is the list of all transactions</small></h1><hr>
EOD;
			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#transactions', time() + (86400 * 30), "/");

			$this->load->view('pages/transaclist_v', $data);
		}
	}
    
    /* getting all transactions (admin)*/
    public function gettransaclist($from,$to,$type = 'all')
    {
        $res = $this->tm->get_transacs($from, $to, $type);
        print $res;
    }
    
    /* getting all the transaction by  a particular agent */
    public function gettransacbyagent($from, $to, $type = 'all')
    {
        
        $agentid = get_cookie('user_id');
        
        $res = $this->tm->get_agenttransac($from, $to, $type, $agentid);
        print $res;
    }
}
