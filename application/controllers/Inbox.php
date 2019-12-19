<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* MANAGER INBOX ON EACH TRANSACTION SENDED FOR HER/ HIS REGARDLESS OF WHERE THESE TRANSACTION COME FROM */

class Inbox extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
	}

	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Inbox (收件箱)";
			$data['header'] = <<<EOD
				<h1 class="page-header" style="font-size: 27px;"> Inbox (收件箱)<small> This are the transactions recieved for approval </small></h1> <hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
			setcookie('active', '#inbox', time() + (86400 * 30), "/");

			$this->load->view('pages/mgr_sent_v', $data);
		}
	}
    
    /* INBOX CUSTOM VIEW (DATATABLES) */
    public function dtinbox($type)
    {
        $result = $this->vt->inbox_view($type);
        print $result;
    }
    
    /* REGROUPING ALL THE PENDINGS VISA TRANSACTIONS (must be work now)*/
    public function regroupall()
    {
        $selectedGrp = $_POST['selected_grp'];
        $regroupBy = get_cookie('user_id');        
        $Q = $this->bt->regroup_vt(TRUE, '', $selectedGrp, $regroupBy);
        //regroup_vt($isAll = FALSE, $transNumArr, $selectedGrp, $regroupBy)
         return_json($Q, TRUE);
    }
    
    /* REGROUP ONLY SOME OF THE VISA TRANSACTION */
    public function selectedregroup()
    {
        $transArr    = $_POST['trans_arr'];
        $selectedGrp = $_POST['selected_grp'];
        $regroupBy = get_cookie('user_id');
        $Q = $this->bt->regroup_vt(FALSE, $transArr, $selectedGrp, $regroupBy);
        return_json($Q, TRUE);
    }
    
}
