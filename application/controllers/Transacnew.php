<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* AGENT/ADMIN CREATE A NEW TRANSACTION */
class Transacnew extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
        $this->load->library('my_uploader', '', 'uploader');
    }
    
	public function index()
	{
        if(!check_session()){
            redirect('login');
        }
        else
        {
            $data['title'] = "Create Draft(创建草稿)";
    		$data['header'] = <<<EOD
    			<h1 class="page-header"> Draft (草案)<small> Creation of new Draft </small></h1><hr>
EOD;
    		$data['user_dat'] = array(
                    'name'   => get_cookie('fullname'),
                    'pic'    => base_url(get_cookie('profile_pic')),
                    'noti'   => 1, // change these to 0
                    'userid' => get_cookie('user_id')
            );

            $data['acc_type'] = get_cookie('user_type');
            setcookie('active', '#draftagent', time() + (86400 * 30), "/");
            
    		$this->load->view('pages/createtrans_v', $data);
        }
	}
    
    # SAVING THE TRANSACTION (PERFECTLY WORKING) (9:18AM 3/5/2018)
    # UPDATED ON 10:57 AM 3/5/2018 (REMOVE THE ETICKET-FILE TYPE)
    public function savenewtransac()
    {
        
        # process the request
        $passport = strtolower($_FILES['attached_passport']['name']);
        // $eticket  = strtolower($_FILES['attached_eticket']['name']);

        // get the dob convert to ISO
        $dob                = $this->input->post('va_dob');
        unset($_POST['va_dob']);
        $newDob             = $this->vua_lib->isodate($dob);
        $changeNamed1       = str_replace('-', '', $_POST['va_lname'].$_POST['va_fname'].$newDob);
        $changeNamed        = str_replace(' ', '', $changeNamed1);
        $passEx             = pathinfo($passport, PATHINFO_EXTENSION);
        // $ticketEx           = pathinfo($eticket, PATHINFO_EXTENSION);
        $changePassportFile = time().$changeNamed.'_passport.'.$passEx;
        // $changeEticketFile  = time().$changeNamed.'_eticket.'.$ticketEx;

        $attachments = array(
            'attached_passport'  => 'uploads/'.$changePassportFile,
            // 'attached_eticket'   => 'uploads/'.$changeEticketFile,
            'created_by'         => get_cookie('user_id')
        );

        // updated dob + attachments
        $newPost = array_merge($_POST, array('va_dob' => $newDob), $attachments);

        /*array_merge($_POST, array('va_dob' => $newDob))*/
        $isuploaded = FALSE;
        $fileone    = FALSE;
        $filetwo    = FALSE;

        // CHANGING THE FILENAME
        $_FILES['attached_passport']['name'] = $changePassportFile;
        // $_FILES['attached_eticket']['name'] = $changeEticketFile;

        $fileone = $this->uploader->ddo_upload('attached_passport');
        // $filetwo = $this->uploader->ddo_upload('attached_eticket');

        // && $filetwo
        if($fileone){
            $insert  = $this->vt->new_transaction($newPost);
            print 'done';
        }else{
            print 'Unable to upload file';
        }
            
    }
    
}
