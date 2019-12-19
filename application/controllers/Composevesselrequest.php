<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Request letter format for the vessel type Request letter */
class Composevesselrequest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
    
	public function print($rqlId)
	{
		$constuctParam = array(
            'request_id' => $rqlId,
        );
        
        $requestLetterNum = 'Request Letter No.'.$rqlId;
        $this->load->library('cruisetype_rq_pdf', $constuctParam, 'requestlet_cruise');
        
        $this->requestlet_cruise->SetCreator(PDF_CREATOR);
        $this->requestlet_cruise->SetAuthor(PDF_AUTHOR);
        $this->requestlet_cruise->SetTitle($requestLetterNum);
        $this->requestlet_cruise->SetSubject('Request Letter');

        // set default monospaced font
        $this->requestlet_cruise->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $this->requestlet_cruise->SetMargins(10, PDF_MARGIN_TOP, 10);
        $this->requestlet_cruise->setPrintHeader(false);
        $this->requestlet_cruise->setPrintFooter(false);
        
        $this->requestlet_cruise->printCruise();
        
         $this->requestlet_cruise->Output($requestLetterNum.'.pdf', 'I');
	}

}

/* End of file Composevesselrequest.php */
/* Location: ./application/controllers/Composevesselrequest.php */