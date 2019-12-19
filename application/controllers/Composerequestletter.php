<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* controller foe composing the request letter (aiplane mode here)*/
class Composerequestletter extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('requestletter_model', 'rqm');
    }
    
    public function print($rqlId){ // just get the request id then use it to get the request letter informations
        
        $constuctParam = array(
            'request_id' => $rqlId,
        );
        
        $requestLetterNum = 'Request Letter No.'.$rqlId;
        $this->load->library('requestletter_pdf', $constuctParam, 'requestlet');
        
        $this->requestlet->SetCreator(PDF_CREATOR);
        $this->requestlet->SetAuthor(PDF_AUTHOR);
        $this->requestlet->SetTitle($requestLetterNum);
        $this->requestlet->SetSubject('Request Letter');

        // default header data
        $this->requestlet->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $this->requestlet->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->requestlet->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->requestlet->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->requestlet->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->requestlet->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->requestlet->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set image scale factor
        $this->requestlet->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $this->requestlet->AddPage();
        $this->requestlet->Letterheader();
        $this->requestlet->Letterbody();
        $this->requestlet->Respectfully();
        
        $this->requestlet->AddPage();
        $this->requestlet->Sechead();
        $this->requestlet->Visatransactbl();
        // $this->requestlet->Signature();
        
        $this->requestlet->Imagegenerator();
        $this->requestlet->lastPage(true);
        
        $this->requestlet->Output($requestLetterNum.'.pdf', 'I');
    }
    
}// class