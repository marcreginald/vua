<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* AGENT VIEWING OF HIS/ HER  OWN VISA TRANSACTION  */
class Transacview extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
        $this->load->library('my_uploader', '', 'uploader');
	}
    
    /* index with parameter */
	public function index($transId)
	{
        if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "View Details (查看詳情)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> View Details (查看詳情)<small>This are the transactions sent for approval</small></h1><hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        $data['trans_type'] = ' Your transaction from batch <u><strong>BTCH-00902!</strong></u> has been verified. ';
	        setcookie('active', '#draftagent', time() + (86400 * 30), "/");
	        

            if($this->vt->isvt_exist($transId)){

                $q = $this->vt->get_transdata($transId);
                $data['transac_dat'] = $q;
                $data['dob']         = $this->vua_lib->to_datetimepicker($q->va_dob);

                // if transaction data is not null && it exist
                if(!is_null($q)){
                   $data['transac_dat'] = $q;
                   $this->load->view('pages/edittrans_v', $data);
                }

            }else{
                redirect('notfound');
            }
		}
    }
    
    
    /*
        * choice if the attached_passport have a value if it has then 
            * unlink the old picture into the server
            * upate the passport_name in the FILES super global Array to lower then add the time it is uploaded
            * based in the response if success upload the new image into the server
            * then update the transaction image into the server

            return the query response via json or the default: one return into the server

        * else if the attached_passport have no value then. just use the old_passport image file into the server
            * no file uploading make sense just update the necessary information.
    */
    
    /* from now on used these  technique and improve it in the future (updated 2:32 PM 3/5/2018)*/
    public function updatetransac()
    {
        
        $dob = $this->input->post('va_dob');
        unset($_POST['va_dob']);
        $newDob = $this->vua_lib->isodate($dob);
        
        $passName = strtolower($_FILES['attached_passport']['name']); // passport image file
        $formattedPassName = $this->uploader->format_passport($passName, $_POST['va_lname'], $_POST['va_fname'], $newDob);
        
        $addedData = array(
            'va_dob'            => $newDob, 
            'created_by'        => get_cookie('user_id'),
            'attached_passport' => 'uploads/'.$formattedPassName
        );
        
        $data = array_merge($_POST, $addedData);
        
        if(empty($passName)){ // this one is working
            # no change in the passport image just the data with it
            $data['attached_passport'] = $_POST['old_passport'];
            
            $q = $this->vt->update_transaction($data);
            print 'done';
            
        }else{
            
            $unlink = $this->uploader->remove_file($_POST['old_passport']);
            $_FILES['attached_passport']['name'] = $formattedPassName;
            
            $upload = $this->uploader->ddo_upload('attached_passport');
            
            if(!$upload){
                print 'Unable to upload file';
            }else{
                // do the database updation
                $q = $this->vt->update_transaction($data);
                
                if((boolean)$q){
                    print 'done';
                }else{
                    print 'Unable to update transaction';
                }
                
            }// checking if the new passport image been uploaded
        }
        
    }
    
    /* _working (must finalize) (just ready the change image property)*/
    public function updatetransac_old()
    {
        
        // converting to isodate
        $dob    = $this->input->post('va_dob');
        unset($_POST['va_dob']);
        $newDob = $this->vua_lib->isodate($dob);
        
        if(empty($_FILES['attached_passport']['name']) && empty($_FILES['attached_eticket']['name'])){
            
            $addedDat = array(
                'va_dob'     => $newDob,
                'created_by' => get_cookie('user_id')
            );
            
            // die_r(array_merge($_POST, $addedDat));
            $q = $this->vt->update_transaction(array_merge($_POST, $addedDat));
            // return_json((boolean)$q, TRUE);
            print 'done';
        }else{
            
            $oldPasspic   = $_POST['old_passport'];
            $newPasspic   = strtolower($_FILES['attached_passport']['name']);
            $oldEticket   = $_POST['old_eticket'];
            $newEticket   = strtolower($_FILES['attached_eticket']['name']);
            $changeNamed1 = str_replace('-', '', $_POST['va_lname'].$_POST['va_fname'].$newDob);
            $changeNamed  = str_replace(' ', '', $changeNamed1);
            

            $attachedPassport = 'none';
            $attachedEticket  = 'none';
            
            /* CHANGED E-TICKET */
            if(empty($newPasspic)){
                
                $attachedPassport = 'uploads/'.$oldPasspic;
                $attachedEticket  = 'uploads/'.$newEticket;
                $fileone = $this->uploader->ddo_upload('attached_eticket');
                $filetwo = TRUE;

            }else if(empty($newEticket)){ /* CHANGED PASSPORT */
                
                $attachedEticket  = 'uploads/'.$oldEticket;
                $attachedPassport = 'uploads/'.$newPasspic;
                $fileone = TRUE;
                $filetwo = $this->uploader->ddo_upload('attached_passport');
                
            }else{ /* BOTH CHANGE THE NEW AND THE PASSPIC*/
                $attachedPassport = 'uploads/'.$newPasspic;
                $attachedEticket  = 'uploads/'.$newEticket;
                $fileone = $this->uploader->ddo_upload('attached_passport');
                $filetwo = $this->uploader->ddo_upload('attached_eticket');
            }
                
                /* actual uploading*/
                if($fileone && $filetwo){

                    //attached_eticket
                    $attachments = array(
                        'attached_passport'=> $attachedPassport,
                        'attached_eticket' => $attachedEticket,
                        'created_by'       => get_cookie('user_id'),
                        'va_dob'           => $newDob
                    );
                    $q = $this->vt->update_transaction(array_merge($_POST, $attachments));
                    // return_json((boolean)$q, TRUE);
                    if((boolean)$q){
                        print 'done';
                    }else{
                        print 'Unable to update transaction';
                    }

                }else{
                    print 'Unable to upload file Allowed filetype are(jpg, png, jpeg)';
                }

        }
    }

}
