<?php

/* rquest letter for airplain type */
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH .'/third_party/tcpdf/tcpdf.php');

// inheret all the properties in TCPDF.php in
class Downloadvisa_pdf extends TCPDF
{
	protected $ci;

    protected $rqlid   = '';
    protected $transnum = '';

    // constructor method
	public function __construct($data)
	{
		parent::__construct();
        $this->ci =& get_instance(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    $this->rqlid    = isset($data['request_id']) ? $data['request_id'] : '';
        $this->transnum = isset($data['trans_no']) ? $data['trans_no'] : '';
        
        $this->ci->load->model('visatransaction_model', 'vt');
        $this->ci->load->model('batchedvt_model', 'bt');
        $this->ci->load->model('requestletter_model', 'rq');
        
        $requestData = $this->ci->rq->get_rqldraft($this->rqlid);
        // set the visa transaction to be process here
    }

    
/* 1ST PAGE (n)... FUNCTION */
    public function Imagegenerator($type, $transNo = '')
    {
        if($type === 'with_confirmation'){
            $images = $this->ci->rq->get_imgapproved($this->rqlid); // get the image then just generate it using the current request id
        }else{
            $images = $this->ci->rq->get_applicantapprovevisa($transNo); // get the image then just generate it using the current request id
        }
        
        if(is_null($images->confirmation)){
            
            $stamppedImg = $images->passenger_stamppedvisa;
            $this->displayPdfPage($stamppedImg[0]);
            
        }else{
            
            # their is a confirmation on it
            $confirm = $images->confirmation;
            for($i=0, $ln=count($confirm); $i<$ln; $i++){
                $this->displayPdfPage('uploads/'.$confirm[$i]);
            }
            
            # print each of the pdf page here
            $eachStampped = $images->passenger_stamppedvisa;
            for($i=0, $ln=count($eachStampped); $i<$ln; $i++){
                $this->displayPdfPage($eachStampped[$i]['stampped_passport']);
            }
            
        }
        
    }
    
    
    /* just displaying a image to be displayed in pdf */
    private function displayPdfPage($path)
    {
        $this->SetPrintHeader(false);
		$this->AddPage();
		$this->Ln(25);
		// $imgPath = base_url($img->attached_passport);

		$this->Image($path, $this->GetX() + 20, $this->GetY() - 30, $w=150, $h=160, $type='', $link='', $align='M', $resize=true, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array());
		
		#public function Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())
    }
    
/* 3RD PAGE ... END FUNCTION */

    
/* SOME PRIVATES METHODS HERE */
    private function toisodate($dpcikerDate)
    {
        $this->ci->load->library('vua_lib');
        return $this->ci->vua_lib->isodate($dpcikerDate);
    }

}

/* End of file My_pdf.php */
/* Location: ./application/libraries/My_pdf.php */
