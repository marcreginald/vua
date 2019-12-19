<?php

/* rquest letter for (airplain type) */
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH .'/third_party/tcpdf/tcpdf.php');

// inheret all the properties in TCPDF.php in
class Cruisetype_rq_pdf extends TCPDF
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
    
    protected $totalpax = '';

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

    /* the header part of the cruise request letter */
    private function getVisaBatchInfo()
    {
        # just the header then return the string containing the header
        # use the $batchNum to get the PDF header 
        # bala man adto kung uno man adtong 0800H na adto da ako paki kanya.
        // rqlid
        $batchInfo = $this->ci->bt->get_pdfbatchtransac($this->crntbatchnum);
        
        $vesselVia = strtoupper($batchInfo[0]->via);
        $totalPax  = $this->totalpax;
        $arrival   = date('d-M-Y', strtotime($batchInfo[0]->arrival));
        $batchNum  = explode('-', $this->crntbatchnum)[1];
        $portOfEntry = ucwords($batchInfo[0]->poe);
        
        
        /*
            08-MAR-2018/0800H
        */
        $tblThead = <<<EOD
        
        <table border="1" cellpadding="5">
           <tr>
            <th colspan="3" style="text-align:left;">Vessel: $vesselVia</th>
            <th style="text-align:center;">B# $batchNum=$totalPax pax. </th>
           </tr>

           <tr>
             <th colspan="4" style="text-align:left;">Estimated Date/Time of Arrival: $arrival</th>
           </tr>

           <tr>
              <th colspan="4" style="text-align:left; font-size:14px;" cellpadding="10">Above mentioned vessel is arriving at $portOfEntry </th>
           </tr>

           <tr>
              <th colspan="4" align="center" style="font-size:14px; padding:10px; "> <b><u> VISA UPON ARRIVAL (under Sec. 5 of D.C 041) List of applicants </u></b></th>
           </tr>

           <tr style="text-align:center;">
              <td width="40%" align="center" >Name <br>(英文姓名)</td>
              <td width="10%" align="center" >Gender<br>(性別)</td>
              <td align="center" >Date of Birth <br> (出生日期)</td>
              <td align="center" >Passport Number <br> (護照號碼)</td>
           </tr>
EOD;
        return $tblThead;
        
    }
    
    /* */
    public function getApplicantInfo($applicantArr, $pageOrientation='L', $pageSize='A4', $applicantNum = -1)
    {
        
        $tblThead = $this->getVisaBatchInfo(); // retun aarray of object of visa applicant
        
        /*
            if the applicantArr is > than to the 14 subscript total of 15 elements. 
            then 
              * format each row for the table data (each array object)
              * then after the 14th subscript successfuly done. 
              * the formatted each table rows output the page with the default orientation and page size on it
              * then splice the  array from the subscript 0 upto the current i
              * then recurs it to the function to make it every day happy :D algorithm is LOVE
              * then in the print cruise function call the getApplicant Info 2X

            upon testing  just make the coditional variable slicer to 2
        */
        
        ($pageOrientation === 'P' ? $this->SetCellMargins(15, 0, 0, 0) : '');

        if(count($applicantArr) > 16){ // 14 dapat para upto the 15 applicant info kaya
            
            $trList = '';
            for($i=0, $ln=count($applicantArr); $i<=16; $i++){
                
                $applicantNum += 1;
                $fullName = $this->format_name($applicantNum.'.', $applicantArr[$i]->fname, $applicantArr[$i]->lname);
                $gender   = $applicantArr[$i]->gender;
                $dateOFB  = $this->cruise_date($applicantArr[$i]->dob);
                $passNum  = strtoupper($applicantArr[$i]->pass_num);
                
                $tr = <<<EOT
                <tr>
                    <td> $fullName </td>
                    <td style="text-align:center;"> $gender   </td>
                    <td style="text-align:center;"> $dateOFB  </td>
                    <td style="text-align:center;"> $passNum  </td>
                </tr>        
EOT;
                $trList .= $tr;
            }
            
            $tblThead .= $trList;
            $tblThead .= "</table>";
                        
            $this->AddPage($pageOrientation, $pageSize);
            $this->SetFont('cid0jp', '', 10);
            $this->writeHTMLCell($w=160, $h=175, $x='', $y=($this->GetY() - 18), $tblThead, $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);

            array_splice($applicantArr, 0, $i);
            $this->getApplicantInfo($applicantArr, $pageOrientation, $pageSize, $applicantNum);

        }else{
            
            $trList = '';
                for($i=0, $ln=count($applicantArr); $i<$ln; $i++){
                    
                    $applicantNum += 1;
                    
                    $fullName = $this->format_name($applicantNum.'.', $applicantArr[$i]->fname, $applicantArr[$i]->lname);
                    $gender   = $applicantArr[$i]->gender;
                    $dateOFB  = $this->cruise_date($applicantArr[$i]->dob);
                    $passNum  = strtoupper($applicantArr[$i]->pass_num);
                    
                    $tr = <<<EOT
                    <tr>
                        <td> $fullName </td>
                        <td style="text-align:center;"> $gender   </td>
                        <td style="text-align:center;"> $dateOFB  </td>
                        <td style="text-align:center;"> $passNum  </td>
                    </tr>        
EOT;
                    $trList .= $tr;
                }
            
                $tblThead .= $trList;
                $tblThead .= "</table>";
                                
                
                $this->AddPage($pageOrientation, $pageSize);
                $this->SetFont('cid0jp', '', 10);
                $this->writeHTMLCell($w=160, $h=175, $x='', $y=($this->GetY() - 18), $tblThead, $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true);
            
        }

    }
    
    /* index here the one who will generate the cruise type request letter */
    public function printCruise()
    {
        # get the $this->rqlid

        /* you aint gonna need the validation of the request letter id cause the open modal is validated with the id and the url address bar was. unable to changed */
        $Applicants = $this->ci->rq->rql_applicants($this->crntbatchnum);
        $this->totalpax = count($Applicants);
        # getApplicantInfo($applicantArr, $pageOrientation='L', $pageSize='A4')
        
        $this->getApplicantInfo($Applicants); // for the horizontal pdf cruise request letter

        $this->getApplicantInfo($Applicants, 'P');
        $this->lastPage(true);
    }

    
/* SOME PRIVATES METHODS HERE */
    private function toisodate($dpcikerDate)
    {
        $this->ci->load->library('vua_lib');
        return $this->ci->vua_lib->isodate($dpcikerDate);
    }
    
    /* 
        create the Date of Birth in a cruise(vessel) type request letter format 
        (2018.03.13)
    */
    private function cruise_date($isoDate)
    {
        /* just format the date ISO date into */
        /*
            2018-02-14  => 2018.02.14 
        */
        $dateArr = explode('-', $isoDate);
        /*
            array =>(
                [0] => 2018,
                [1] => 02,
                [2] => 14
            )
        */
        return $dateArr[0].'.'.$dateArr[1].'.'.$dateArr[2];
    }
    
    
    /* the naming number just access the $crntCtr */
    /*
        param: $lName => last name
        param: $fName => first name
        return (UPPERCASE NAME)
    */
    private function format_name($number, $fName, $lName)
    {
        $crntCtr = ($number + 1);
        $newName= strtoupper($crntCtr.' '.$lName.','.$fName);
        $crntCtr = ($crntCtr +1);
        return $newName;
    }

    
    /* 
        $this->rq->rql_applicants($batchNum)
    */
}

/* End of file My_pdf.php */
/* Location: ./application/libraries/My_pdf.php */


/* 
    9:36 AM 3/19/2018
    => Wrong page number on setPage() 
        sol: make sure that you add a page for for the pdf dont forget about it

*/
