<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* SPECIFIC FOR VIEWING VIA MANAGER */
class Mgrtransacview extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->library('my_uploader', '', 'uploader');
	}
    
    # INDEX WITH TRANS_NO
    public function index($transId)
	{
        $this->load->model('batchrequest_model', 'btrq');
        
        if(!check_session()){
			redirect('login');
		}
		else
		{
            /* get the batch_number then */
            /* update its status to become read */
            $batchNum = $this->vt->get_vtbatchnum($transId); // updating to read
            $q = $this->bt->get_batchtransdata($transId);
	        $data['title'] = "View";
            
            if($q->status == "VERIFIED"){
                $data['header'] = <<<EOD
				<h1 class="page-header"> Verified transaction (驗證交易)<strong style="text-transform:uppercase; font-size: 18px;" id="header-transno"> $q->trans_no </strong></h1> <hr>
EOD;
            }else{
                $data['header'] = <<<EOD
				<h1 class="page-header"> Request to verify transaction (請求驗證交易)<strong style="text-transform:uppercase; font-size: 18px;" id="header-transno"> $q->trans_no </strong></h1> <hr>
EOD;
            }

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
            // $data['trans_type'] = ' Your transaction from batch <u><strong>BTCH-00902!</strong></u> has been verified. ';
	        setcookie('active', '#inbox', time() + (86400 * 30), "/");
	        
            $data['transac_dat'] = $q;
            $data['dob']         = $this->vua_lib->to_datetimepicker($q->dob); //converting ISO date to (mm-dd-YYYY)
            $data['arrival']     = $this->vua_lib->to_datetimepicker($q->arrival); //converting ISO date to (mm-dd-YYYY)

            if(!is_null($q)){
               $data['transac_dat'] = $q; // out of sync cause the stored proc must be in the bottom 
               $this->load->view('pages/mgr_verify_v', $data);
            }
		}
	}

    /* VERIFICATION */
    # GO TO THE UTIL
    
    /* JUNKING */
    # GO TO THE UTIL 
    
    /* SAVING THE UPDATED CLIENT INFO */
    public function updateclientinfo()
    {
        
        $dob = $_POST['va_dob'];
        unset($_POST['va_dob']);
        $newDob  = $this->vua_lib->isodate($dob);
        $newPost = array_merge($_POST, array('va_dob' => $newDob));
        
        // die_r($newPost);
        $Q = $this->vt->update_transaction($newPost); // kapatal bukong so updated post so binato ko paiyang model
        return_json($Q, TRUE);
    }
}
