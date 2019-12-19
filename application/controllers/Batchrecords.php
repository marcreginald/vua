<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* MANAGER BATCH OF TRANSACTION LIST */
class Batchrecords extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->library('my_uploader', '', 'uploader');
	}

	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else{

			# PAGE AND USER DATA
			$data['title'] = "Batch Records (撰寫信件)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Batch Records (撰寫信件)<small> Compose Request Letter per batch. </small></h1><hr>
EOD;
	
			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#batchrecords', time() + (86400 * 30), "/");

			$this->load->view('pages/mgr_batchrec_v', $data);
		}
        
	}
    
    public function savesendbatch()
    {
        /*
            ALGO:
                - USE THE ALGO IN UPLOADING THE MULTIPLE FILE INTO THE SERVER
                - SAVE THE PATHS INTO THE DATABASE PREPENDING THE php time() function. + the necessaryinformation in the 
                - THEN RETURN A JSON FLAG DATA TO SPECIFY IF IT IS SUCCESSFULLY UPLAODED OR NOT.
        */
        $travelType   = $this->input->post('travel_type');
        $arrivalDate  = $this->input->post('arrival');
        $via          = $this->input->post('via'); // airline or cruise name of what it is
        $flightVoyage = $this->input->post('flight_or_voyagenum'); // flight number or cruise number
        $portEntry    = $this->input->post('port_of_entry');
        
        
        $eticketFullPath = '';
        if(isset($_FILES['attached_eticket'])){
         
            $uploading = FALSE;
            foreach($_FILES['attached_eticket']['tmp_name'] as $i => $tmp_name){
                // 
                $fileName = $i.$_FILES['attached_eticket']['name'][$i];
                $fileSize = $_FILES['attached_eticket']['size'][$i];
                $fileTmp  = $_FILES['attached_eticket']['tmp_name'][$i];
                $fileType = $_FILES['attached_eticket']['type'][$i];
                
                $newName = $i++.$this->uploader->format_eticket($fileName, $travelType, $arrivalDate, $via, $flightVoyage, $portEntry);
                
                $eticketFullPath .= 'uploads/'.$newName.'&';
                
                $uploading &= move_uploaded_file($fileTmp, 'uploads/'.$newName);
                
            }
                    
            $q = $this->bt->sendsavebatch($_POST, $_POST['slctd'], get_cookie('user_id'), rtrim($eticketFullPath, '&'));
            return_json((boolean)$q, TRUE);
            
        }else{
            
            return_json(FALSE, TRUE);
        }
        
    }
    
    # SAVING THE NEW BATCH ALL (use in save send) 
    # (single eticket-version as of 3:40 PM 3/12/2018)
    public function savesendbatch_old()
    {
        
        /*
            save the $FILE into the server  then  save its  information in the database 
        */
        
        $senderId     = get_cookie('user_id');
        $tType        = $this->input->post('travel_type');
        $arrivalDate  = $this->input->post('arrival');
        $via          = $this->input->post('via');
        $flightVoyage = $this->input->post('flight_or_voyagenum');
        $portEn       = $this->input->post('port_of_entry');


        $eticketName    = $_FILES['attached_eticket']['name'];
        $formattedName  = $this->uploader->format_eticket($eticketName, $tType, $arrivalDate, $via, $flightVoyage, $portEn); 
        // formatted name for the eticket
        $_FILES['attached_eticket']['name'] = $formattedName;
        
        if($this->uploader->ddo_upload('attached_eticket')){
            
            $q = $this->bt->sendsavebatch($_POST, $_POST['slctd'], $senderId, $formattedName);
            return_json((boolean)$q, TRUE);
            
        }else{
            
            return_json(FALSE, TRUE);
            
        }
        /*$senderId = get_cookie('user_id');
        $q = $this->bt->sendsavebatch($_POST['travelinfo'], $_POST['selected'], $senderId);   
        return_json((boolean)$q, TRUE);  */      
    }
    
    /* DISPLAYING ALL GENERATED BATCH WITH ITS OWN INFORMATION TO BE USED */
    public function dtbatchrecords()
    {
        $result = $this->bt->all_batchrecords();
        print $result;
    }
    
    /* DISPLAYING THE TRANSACTIONS ON A BATCH */
    public function getbatchtransac($batchNum)
    {
        $result = $this->bt->get_batchtransac($batchNum);
        
        $this->tagbatchrqlread($batchNum); // assigning as read
        print json_encode($result);
    }
    
    /* new download eticket with auto totalPax+via+flight or voyage number ()*/
    public function downeticket($batchnum)
    {
        $this->load->library('zip');
        $this->load->helper('file');
        
        /* udpated version on downloading a zip file from the server= */
        if($this->bt->isbt_exist($batchnum)){
            
            // implode the etickets
            // then foreach it to append in the zip library
            // get the 
            
            $res = $this->bt->get_batch_eticket_names($batchnum);
            $zipname = $res->zipname;
            $etickets = $res->etickets; // string delimited by &
                        
            foreach(explode('&', $res->etickets) as $ticket){
                $this->zip->read_file($ticket, false);
            }
            
            $this->zip->download($zipname);
            
        }else{
            return_json(FALSE, TRUE);
        }
    }
    
    /* DOWNLOADING THE E-TICKET FILE IN A PARTICULAR BATCH sugoi:) (downloading a single file from the server)*/
    /* method been deprecated as of 12:38 PM 3/13/2018 */
    public function downeticket_old($upload, $file)
    {
        $this->load->helper('download');    
        $path = './'.urldecode($upload.'/'.$file);
        // $Fpath= $path;
        force_download($path, NULL);

    }
    
/* PRIVATE CONTROLLER METHOD/S */
    /* tagging a batch transaction to read status */
    public function tagbatchrqlread($batchNum)
    {
        $datetime = date('Y-m-d H:i:s'); 
        $this->db->where('batch_no', $batchNum);
        $q = $this->db->update(BATCH_RQLLOGS, array('batchrequest_stat' => 'read', 'date_sentlogs' => $datetime));
    }
    
}
