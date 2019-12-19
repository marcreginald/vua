<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* test controller to check each functionality of the process. 
   use for functional testing and all sort of testingss.
*/
class Test extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'usr');
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('twobatchvt_model', 'tbt');
        $this->load->model('requestletter_model', 'rq');
        $this->load->helper('file');
        $this->load->library('my_uploader', '', 'uploader');
        $this->load->model('visaview_model', 'vv');
        $this->load->model('batchrequest_model', 'btrq');
    }
    
    public function index(){
        echo phpinfo();
    }
    
    public function index_osda($rqlId=4, $transNum='')
    {        
        
       /*
         PROBLEM (*) CREATE A PDF CONTAINING BOTH THE VERTICAL AND HORIZONTAL CRUISE REQUEST LETTER PDF.
       
         SOL:
           1. CREATE A NEW CLASS TO HANDLE NAMED IT Cruisetype_rq_pdf
           2. EXTEND THE TCPDF class to acquire its properties and methods
           3. DESIGN THE Cruisetype_rq_pdf AS A templating class for both horizontal and vertical Request Letter Cruise
           4. Use it in a additional Controller to reduce cohesion and to implement high coupling
        
        INPUT:
           1. _ BASED IN THE REQUEST LETTER ID
              _ THEN IT AUTOMATICALLY GET ALL THE RELATED ON THE CRUISE TYPE REQUEST LETTER.
              
              SUCCESS MUST BE CHECKED AFTER LUNCH
              
       */
        $constuctParam = array('request_id' => $rqlId, 'trans_no' => $transNum);
        
        $this->load->library('downloadvisa_pdf', $constuctParam, 'down_visa');
        
        $this->down_visa->SetCreator(PDF_CREATOR);
        $this->down_visa->SetAuthor(PDF_AUTHOR);
        $this->down_visa->SetTitle('Download');
        $this->down_visa->SetSubject('Request Letter');

        // set default monospaced font
        $this->down_visa->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $this->down_visa->SetMargins(10, PDF_MARGIN_TOP, 10);
        $this->down_visa->setPrintHeader(false);
        $this->down_visa->setPrintFooter(false);
        
        if($transNum === ''){
            $this->down_visa->Imagegenerator('with_confirmation');
        }else{
            $this->down_visa->Imagegenerator('no_confirmation', $transNum);
        }
        
        $this->down_visa->Output('download.pdf', 'I');
          
    }
    
    /* modal creator (tester for each functionality of the system)*/
    /* 3/13/2018 => downlading the zip request letter */
	public function index_download($batchnum)
	{
        $this->load->library('zip');
        $this->load->helper('file');
        
        /*$path = './uploads/';
        
        $eTickets = get_filenames($path);*/
        // second parameter to include the full path C:\ blah blah
        /*
        die_r($eTickets);
        echo "<hr>";*/
        /*foreach($eTickets as $ticket){ // jus the file name output these so it must prepened with the server upload file.
            $this->zip->read_file($path.$ticket, false); // adi second argument kung e iiba padi folder pero buko man na magayon an kaiba payan ehh 
        }*/
        
        // $this->zip->download('Downloads');
        // die_r($eTickets);
        // die_r($this->zip);
        // $this->output->enable_profiler(TRUE);
        
        
        /*
            algo in the downloading of the eticket the eticket must be in the util part()
            
            
            just for loop the imploded array  of the file into the server then 
            
            get the flight details of that particular batch,, make it as the name of the zip file.
            
            then download it.
        
        */
        
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
    
    public function testapi()
    {
        $testTrans = 'trans-1';
        $res = $this->rq->get_applicantapprovevisa($testTrans);
        
        die_r($res);
    }
 
    
    /* NEW :) MAGIC */
    
    /*
      9:18 AM 3/13/2018
        helper:file 
        (+) get_filenames($serverPath, $isFromBasePath)
            => return the single index array of the file with its extension in the supplied arguments
          ex.
           $controllers = get_filenames(APPPATH.'controllers/');
    */
    
    /*
      9:20 AM 3/13/2018
        library:zip
        (+) read_file($path, $mainTainOldName);
            => ibinubuntang sa current the butangan pang zip a specified na file. 
            => file must have its proper name with its extension
    */
    
    /* 
      9:22 AM 3/18/2018
        library:zip
        (+) download($filename = 'backup.zip')
           => gather all the file in the zip class then download it from the client web browser.
    */
}
