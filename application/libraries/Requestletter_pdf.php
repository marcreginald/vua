<?php

/* rquest letter for airplain type */
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH .'/third_party/tcpdf/tcpdf.php');

// inheret all the properties in TCPDF.php in
class Requestletter_pdf extends TCPDF
{
	protected $ci;

    protected $rqlid   = '';
    protected $crntbatchnum = ''; // crntbatchNumber
    protected $to      = ''; // commisioner name
    protected $date    = ''; // header date
    protected $signatory = ''; // request letter assignatory

    protected $arrival = ''; // arrival date
    
    protected $fovnum  = ''; // flight or voyage number
    
    protected $poe     = ''; // port of entry
    
    protected $via = ''; // via
    
    protected $assigname = '';
    protected $assigtitle = '';

    // constructor method
	public function __construct($data)
	{
		parent::__construct();
        $this->ci =& get_instance(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    $this->rqlid = $data['request_id'];
        
        $this->ci->load->model('visatransaction_model', 'vt');
        $this->ci->load->model('batchedvt_model', 'bt');
        $this->ci->load->model('requestletter_model', 'rq');
        
        $requestData = $this->ci->rq->get_rqldraft($this->rqlid);
        $this->crntbatchnum = $requestData->batch_no;
        $this->to        = $requestData->rq_to;
        $this->date      = $requestData->letter_date;
        $this->signatory = $requestData->assignatory;
        
        // set the visa transaction to be process here
    }

/* 1ST PAGE FUNCTIONS */
    // header
    public function Header()
    {
        $imageFile = K_PATH_IMAGES.'uniletterhead.jpg';
        $this->Image($imageFile, 0, 0, 200, '', 'JPG', '', 'L', true, 300, '', false, false, 0, false, false, false);
        #Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())
    }

    // footer
    public function Footer()
    {
        
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        															# total-page
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R', false, '', 0, false, 'T', 'M');
        #Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    }
    
    /* request letter header */
    public function Letterheader()
    {
        // query here then supply it at the bottom
        $boiData = $this->ci->rq->get_boiinfo($this->to);
        
        $comName = ucfirst($boiData->current_commisioner);
        $title   = 'Commissioner';
        $dept    = ucfirst($boiData->department);
        $addr    = ucfirst($boiData->address);
        
        
        $this->SetFont('helvetica', 'N', 11);
        $this->SetCellMargins(0, 10, 0, 0);
        $this->Write(20, date('F d, Y', strtotime($this->date)), '', false, 'L', true); // refractoring 
        #Write($h, $txt, $link='', $fill=false, $align='', $ln=false, $stretch=0, $firstline=false, $firstblock=false, $maxh=0, $wadj=0, $margin='')
        
        $commisioner = <<<EOD
            <b> $comName </b>
            <br><span> $title </span>
            <br><span> $dept </span>
            <br><span> $addr </span>
EOD;
        
        $this->SetCellMargins(0, 10, 0, 0);
        $this->MultiCell(100, 0, $commisioner, 0, '', false, 1, '', '', true, 0, true, true, '', 'M');
        # MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)
    }
    
    /* request letter body */
    public function Letterbody()
    {
        $batchDat = $this->ci->bt->get_pdfbatchtransac($this->crntbatchnum);
        
        $this->arrival = date('M. d, Y', strtotime($batchDat[0]->arrival));
        $this->fovnum  = strtoupper($batchDat[0]->fov);
        $this->poe     = ucwords($batchDat[0]->poe);
        $this->via     = ucwords($batchDat[0]->via);
        
        $this->SetCellMargins(2,10,0,0);
        $this->setCellPaddings(0, 2, 0, 0);
        $this->SetFont('helvetica', '', 11);
        $letterBody = <<<EOD
        <p style="text-indent:10px;"> This is to formally request from your good office for the processing of Visa Upon Arrival to Nationals of Peoples Republic of China under Department Circular 041. We have an incoming passengers arriving on  <u><b>$this->arrival</b></u> via $this->via flight number <u><b>$this->fovnum</b></u> with Port of Entry at <u><b>$this->poe</b></u>. </p>    
EOD;
        
        $this->MultiCell(0, 0, $letterBody, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
        
        $this->SetCellMargins(2, 5, 0, 0);
        $letterBodyTwo = <<<EOD
        <p> Attached herewith are the name list and passport details of the said group and all the pertinent documents needed in the processing of VUA. </p>
        
        <br>
        <p>Anticipating your favourable consideration and thank you very much.</p>
EOD;
        $this->MultiCell(0, 0, $letterBodyTwo, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
    }
    
    public function Respectfully()
    {
        $assigDat = $this->ci->rq->get_assiginfo($this->rqlid);
        
        $this->assigname  = ucfirst($assigDat->fullname);
        $this->assigtitle = ucfirst($assigDat->req_position);
        
        $this->SetCellMargins(2, 50, 0, 0);
        $this->Write(0, 'Respectfully yours,', '', false, 'L', true);
        
        $this->SetCellMargins(2, 15, 0, 0);
        $this->SetFont('helvetica', 'B', 11);
        $this->Write(0, $this->assigname, '', false, 'L', true);
        $this->SetCellMargins(2, 0, 0, 0);
        $this->SetFont('helvetica', 'N', 11);
        $this->Write(0, $this->assigtitle, '', false, 'L', true);

        
        #Write($h, $txt, $link='', $fill=false, $align='', $ln=false, $stretch=0, $firstline=false, $firstblock=false, $maxh=0, $wadj=0, $margin='')
    }
    
/* END OF 1ST PAGE FUNCTIONS */
    
/* 2ND  PAGE FUNCTIONS */
    
    // 2nd page header (Second Head)
    public function Sechead()
    {
        
        $this->Ln(18);
        $this->SetFont('helvetica', 'N', 11);
        /*$this->Write(0, 'The following passengers listed below will be travelling to the country on  January 02, 2018  via Xiamen Airlines flight number MF8013 with port of entry at Cebu International Airport:');*/
        $tableHead = <<<EOD
        <p> The following passengers listed below will be travelling to the country on  <u><b>$this->arrival</b></u>  via $this->via flight number <u><b> $this->fovnum </b></u> with port of entry at <u><b> $this->poe:</b></u> </p>    
EOD;
        $this->MultiCell($w = 0, $h = 0, $tableHead, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=4, $ishtml=true, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
    }
    
    // vua visa transaction tbl
    public function Visatransactbl()
    {
         // create in the model the function that returning the tr of each batch transaction
         $trList = $this->ci->rq->get_batchpassengerlist($this->crntbatchnum);
         $this->SetCellMargins(0, 10, 0, 0);
         $tableHeader = '<h3><b>VISA UPON ARRIVAL (under Sec. 5 of D.C. 041) List of applicants</b></h3>';
         $this->writeHTMLCell($w='', $h='', $x='', $y='', $tableHeader, $border=0, $ln=1, $fill=false, $reseth=true, $align='C', $autopadding=true);
         #writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
         
         $html = <<<EOT
         <table cellpadding="1" cellspacing="1" border="1">
            <tr style="text-align:left;">
                <th style="width:10%; font-weight:bold;"> NO. </th>
                <th style="width:40%; font-weight:bold;"> Name </th>
                <th style="width:10%; font-weight:bold;"> Gender </th>
                <th style="width:15%; font-weight:bold;"> Date of Birth </th>
                <th style="width:25%; font-weight:bold;"> Passport Number </th>
            </tr>
            
            $trList
            
        </table>
EOT;
        $this->SetCellMargins(0, 5, 0, 0);
        $this->writeHTMLCell($w='', $h='', $x='', $y='', $html, $border=0, $ln=1, $fill=false, $reseth=true, $align='', $autopadding=true);
        
    }
    
    // signature (deprecated for the use of 2nd page)
    public function Signature()
    {
        $this->SetCellMargins(2, 13, 0, 0);
        $this->SetFont('helvetica', 'B', 11);
        $this->Write(0, $this->assigname, '', false, 'L', true);
        $this->SetCellMargins(2, 0, 0, 0);
        $this->SetFont('helvetica', 'N', 11);
        $this->Write(0, $this->assigtitle, '', false, 'L', true);
    }
/* 2ND  PAGE END FUNCTIONS */
    
/* 3RD PAGE ... FUNCTION */
    public function Imagegenerator()
    {
        $images = $this->ci->rq->get_batchpasspic($this->crntbatchnum);
        
        
        foreach($images as $img){
            /* all the images in the database for that particular batchNumber to approved */
            $this->SetPrintHeader(false);
            $this->AddPage();
            $this->Ln(25);
            // $imgPath = base_url($img->attached_passport);
            $imgPath = $img->attached_passport;


            $this->Image($imgPath, $this->GetX() + 25, $this->GetY() - 20, $w=125, $h=90, $type='', $link='', $align='M', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array());
            
            #public function Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())
        }
        
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
