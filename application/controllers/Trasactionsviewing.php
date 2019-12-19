<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* BASED FOR THE TRANSACTIONS TO VIEW THE TRANSACTION VIEWING */
class Trasactionsviewing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('twobatchvt_model', 'tbt');
        $this->load->model('user_model', 'usr');
	}
    
    public function index($transId)
	{
        if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "View";

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#transactions', time() + (86400 * 30), "/");
	        

            /* not yet finish ready for the approved visa transaction */
            if($this->vt->isvt_exist($transId)){

                $q = $this->vt->get_transdata($transId);
                
                $stat = $q->trans_status; // visa status 
                
                $qBt = $this->bt->get_batchinfo($q->batch_no); // getting the batch info
                
                switch($stat){
                 
                    case 'VERIFIED':
                        $data['header'] = <<<EOD
                        <h1 class="page-header">  
                            Transaction#. <strong style="text-transform:uppercase; text-decoration:underline;"> $q->trans_no </strong> has been verified.
                        </h1><hr>
EOD;
                    break;
                        
                    case 'PROCESSED':
                        $data['header'] = <<<EOD
                        <h1 class="page-header">
                            Transaction#. <strong style="text-transform:uppercase; text-decoration:underline;"> $q->trans_no </strong> has been processed.
                        </h1><hr>
EOD;
                    break;
                        
                    case 'PENDING':
                        $data['header'] = <<<EOD
                        <h1 class="page-header"> Request to verify transaction#.  
                            <strong style="text-transform:uppercase; text-decoration:underline;"> $q->trans_no </strong>
                        </h1><hr>
EOD;
                    break;
                    
                    default:
                        $data['header'] = <<<EOD
                        <h1 class="page-header">  
                            Transaction#. <strong style="text-transform:uppercase; text-decoration:underline;"> $q->trans_no </strong>
                            has been approved
                        </h1><hr>
EOD;
                        $data['trans_num'] = $transId;
                    break;
                        
                } // polymorphing
                
                $data['dob']         = $this->vua_lib->to_datetimepicker($q->va_dob);
                $data['arrival']     = $this->vua_lib->to_datetimepicker($qBt->arrival);
                $data['date_sent']   = date('m-d-Y g:i a', strtotime($qBt->date_sent));
                $data['transac_dat'] = (object)array_merge((array)$q, (array)$qBt);
                $data['sender_info'] = $this->usr->get_emailfname($qBt->batch_sender);
                // if transaction data is not null && it exist
                if(!is_null($q)){
//                    die_r($data);
                   $this->load->view('pages/transactionsviewing_v', $data);
                }

            }else{
                redirect('notfound');
            }
            
		}
	}
    

}
