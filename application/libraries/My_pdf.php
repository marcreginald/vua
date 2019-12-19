<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH .'/third_party/tcpdf/tcpdf.php');

			 // inheret all the properties in TCPDF.php in
class My_pdf extends TCPDF
{
	protected $ci;

    protected $crntSA = '';

    protected $inclusion;

    // constructor method
	public function __construct($saNum)
	{
		parent::__construct();
        $this->ci =& get_instance(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    $this->crntSA = $saNum['sa'];
        $this->ci->load->model('serviceagreement_model', 'sa');
    }

    /* mahika method */
    public function __get($prop){
      if (property_exists($this, $prop)) {
        return $this->$prop;
      }
    }

    // header
    public function Header(){

        $image_file = K_PATH_IMAGES.'new_logo.jpg';
        $this->Image($image_file, 13, 10, 20, '', 'JPG', '', 'T', true, 300, '', false, false, 0, false, false, false);
        #Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())

        // print the Invoice Number
		$this->SetFont('helvetica', 'B', 15);
        $this->SetCellMargins(0, 3, 0, 0);
		$this->Cell(90, 20, 'SALES INVOICE: '.$this->crntSA, 0, 0, 'L', false, '', 1, false, 'T', 'C');

        // print current date
		$this->SetFont('helvetica', '', 8);
        $this->SetCellMargins(0, 13, 0, 0);
        $this->Cell(0, 10, date('F d, Y'), 0, 0, 'R', false, '', 0, false, 'T', 'M');
        #Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

    }

    // footer
    public function Footer(){

        // Position at 15 mm from bottom
		$this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        															# total-page
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R', false, '', 0, false, 'T', 'M');
    }

    // uni-info
    public function print_uni(){

        $uniInfo = $this->ci->sa->get_uni_orient_info($this->crntSA);
        $uni = <<<EOD
		<b>$uniInfo->uni_name<b> <br>

		<span style="text-align:left; font-weight:normal;">$uniInfo->uni_address</span><br>

		<span style="text-align:left;">Email:
			<u><span style="color:#5D6CDB; font-weight:normal;">$uniInfo->uni_email</span></u>
		</span><br>

		<span style="text-align:left;">Tel:
			<span style="font-weight:normal;">$uniInfo->uni_tel</span>
		</span><br>

		<span style="text-align:left;">Website:
			<em style="font-weight:normal;">$uniInfo->uni_website</em>
		</span>

EOD;
        $this->SetFont('helvetica', '', 10);
		$this->SetCellPaddings(0,0,0,0);
        $this->writeHTMLCell(65, '', $this->getX(), $this->getY() + 10, $uni, 0, 0, false, 'L', true);
		#$w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true
    }

    // sa_client
    public function sa_client(){

        $client= $this->ci->sa->sa_client_contact_dat($this->crntSA);
        
        //parseContactNum
        $parseConNum = ($client->contact_number == '0') ? 'n/a' : $client->contact_number;
        
        $client = '<b style="text-transform:capitalize;">'.$client->client_name.'</b><br>
		<span style="text-align:left; text-transform:capitalize;">'.$client->client_address.'</span><br>
		<b>Contact Person:</b>
		<span>'.$client->contact_name.'</span><br>
		<b>Email:</b>
		<span><u style="color:#5D6CDB;">'.$client->contact_email.'</u></span><br>
		<b>Tel:</b>
		<span>'.$parseConNum.'</span>
		';

        $this->SetFont('helvetica', '', 10);
        $this->SetCellMargins(45, 0, 0, 0);
		$this->MultiCell(65, 0, $client, 0, 'L', false, 0, $this->getX(), $this->getY(), true, true, true);
        #MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)
    }

    // travel info
    public function sa_travelinfo(){

        $this->Ln(1);
        $travel = $this->ci->sa->get_sa_info($this->crntSA);
        $guest = $this->ci->sa->ret_guest_or_group($this->crntSA);

        if($guest->cat == 'guest'){
            $sArrGuest = '';
            foreach($guest->result as $row){
                $arrGuest = str_replace(', ', ' ', $row->guest_names);
                $sArrGuest .= $arrGuest.', ';
            }
        }else{
            // $sArrGuest = implode(', ', array_column($guest->result, 'group_name'));
            $sArrGuest = $guest->result->group_name;
        }
        $fcreatdBy = str_replace(',', '', $travel->created_by);
        $fArrguest = trim($sArrGuest); // trim guest name/s

        $travel1 = <<<EOD
		<b>Date Issued:</b>
		<span>$travel->date_issued</span><br>
		<b>Created by:</b>
		<span style="text-transform:uppercase; font-weight:bold; font-size:10px;"><strong>$fcreatdBy</strong></span><br>
		<b>Guest Name/s:</b>
		<span style="text-transform:uppercase; font-weight:bold; font-size:10px;">$fArrguest</span>
EOD;
        $this->SetFont('helvetica', '', 10);
        $this->SetCellMargins($this->getX() - 15, $this->getY() + 2, 0, 0);
		$this->MultiCell(65, 0, $travel1, 0, 'L', false, 0, '', '', false, true, true);

        // booking ID updated 10:59 1/11/2018
        $bookingID = ($travel->booking_id == 0 ? 'N/A' : $travel->booking_id);
        
        $travel2 = <<<EOD
		<b>Travel Date:</b>
		<span>$travel->travel_date</span><br>
		<b>Booking ID:</b>
		<span>$bookingID</span><br>
		<b>Nights(s):</b>
		<span>$travel->nights</span><br>
		<table>
			<tr>
				<td><b>Adults:</b> $travel->adults</td>
				<td><b>Child:</b> $travel->child</td>
				<td><b>Infant:</b> $travel->infant</td>
				<td><b>Total Pax:</b> $travel->tpax</td>
			</tr>
		</table>
EOD;

        $this->SetFont('helvetica', '', 10);
        $this->SetCellMargins(28, $this->getY() + 2 ,0 ,0);
		$this->MultiCell(90, 0, $travel2, 0, 'L', false, 0, '', '', true, true, true);
        #MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)
    }

    // inclusions , $max
    public function parseInclusion(){
        $this->Ln(12);

        $this->inclusion = $this->ci->sa->get_sa_inclusion($this->crntSA);

        $min = 0;
        $max = count($this->inclusion);

        $this->SetCellMargins($this->getX() - 15, $this->getY() + 10, 0, 0);
        $this->WriteHtml('<b style="letter-spacing:1px;"><i>Invoice Summary</i></b><br>', true, false, true);

        $html = '<table cellpadding="1" cellspacing="1">
        <tr style="text-align:center;">
            <th style="width:12%; font-weight:bold;"> From </th>
            <th style="width:13%; font-weight:bold;"> To </th>
            <th style="width:40%; font-weight:bold;"> Description </th>
            <th style="width:10%; font-weight:bold;"> Nights </th>
            <th style="width:5%; font-weight:bold;"> Qty </th>
            <th style="width:10%; font-weight:bold;"> Unit Price </th>
            <th style="width:10%; font-weight:bold;"> Total Amt </th>
        </tr>
	';

        for ($i=$min; $i < $max; $i++) {

    	$row = $this->inclusion[$i];
        // $nights = ($row['nights'] == 1) ? '' : $row['nights'];
        $nights = ($row['from'] ===  $row['to']) ? '' : $row['nights'];
        $parseFrom = ($row['from'] === '0/00/0000') ? '' : $row['from'];
        $parseTo = ($row['to'] === '0/00/0000') ? '' : $row['to'];
            
        $uprice = number_format($row['unit_price']);
        $total = number_format($row['total']);
        $eachRw = <<<EOD
            <tr style="text-align:center;">
                <td> {$parseFrom} </td>
                <td> {$parseTo} </td>
                <td style="text-align:left;"> {$row['description']} </td>
                <td> {$nights} </td>
                <td> {$row['qnty']} </td>
                <td> {$uprice} </td>
                <td> {$total} </td>
            </tr>
EOD;
		$html .= $eachRw;

            // $pageNum = $this->getPage(); // get the current page
            if ($i >= 14) {
                 // disable the header
                $this->setPrintHeader(false);
                $this->Ln(1);
                $this->SetHeaderMargin(PDF_MARGIN_HEADER - 10);
                // $this->addPage();
            }
        }

        $html .= '</table>';

        $this->SetFont('helvetica', '', 9);
        $this->MultiCell(0, 0, $html, 0, '', false, 1, '', $this->getY(), true, true, true);
        #MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)
    }

    // subtotal and grand
    public function sub_grand(){

        $this->Ln(6);

        // get the own remarks
        $ownRemarks = $this->ci->sa->getsaownremarks($this->crntSA);
        $this->SetCellMargins(0, 5, 0, 0);
        $ownRemarks = '<span style="font-weight:bold;">Remarks :</span>'.$ownRemarks;
        $this->MultiCell(50, 1, $ownRemarks, 0, 'L', false, 0, '', '', true, 0, true, true);


        // $this->Ln(4);
        $travel = $this->ci->sa->get_sa_info($this->crntSA);

        // $this->SetCellMargins($this->getX() + 74, 10, 0, 0);
        $this->SetCellMargins(40, 0, 0, 0);
        $sub = number_format($travel->subtotal);
        $sub_desc = strtolower(($travel->act == 'none') ? '' : $travel->act);
		$subAction = ($travel->act_amt > 0) ? number_format($travel->act_amt) : 0;
		$crntCurr = $this->ci->sa->sa_inc_currency($this->crntSA);
		$grand = number_format($travel->grand_total);

        $subGrand = '
				<b>Subtotal: </b>
				<span>'.$sub.'</span><br>
                '.$sub_desc.'
				<b>   <span>  </span> (+/-):   </b>
				<span>'.$subAction.'</span>
				<h3><b>GRAND TOTAL('.$crntCurr.'): </b> '.$grand.'</h3>
		';
		$this->MultiCell(90, 5, $subGrand, 0, 'R', false, 2, '', '', true, 0, true, true);
        #MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)
    }

    // refer and money to word
    public function ref_wordmoney(){

        // refer payment
        $this->Ln(10);
		$this->SetCellMargins(0, 15, 0, 0);
		$this->SetFont('courierI', '', 8);
		$refer = 'Please refer to above of your term of payment and settle your payment to our bank details below.';
		$this->MultiCell(90, 5, $refer, 0, 'L', false, 1, '', '', true, 0, false, true);

        $currency = $this->ci->sa->sa_inc_currency($this->crntSA);
        $bankDetails = $this->ci->sa->getbankcurrencydetails($currency);
        // bank_currency
        $htmBankAcc = '
		<b>A/C Name &nbsp; &nbsp;: </b>
		<span>'.$bankDetails->acc_name.'</span><br>
		<b>Bank Name &nbsp;: </b>
		<span>'.$bankDetails->bank_name.'</span><br>
		<b>Branch &nbsp; &nbsp;  &nbsp; &nbsp;  : </b>
		<span>'.$bankDetails->branch.'</span><br>
		<b>Account &nbsp; &nbsp; &nbsp;  : </b>
		<span>'.$bankDetails->acc_num.'</span><br>
		<b>Address &nbsp; &nbsp; &nbsp; : </b>
		<span>'.$bankDetails->branch_addr.'</span><br>
		<b>Swift Code &nbsp; : </b>
		<span>'.$bankDetails->swift_code.'</span>
		';


        $this->SetFont('helvetica', '', 10);
		$this->SetCellMargins(0, 10, 0, 0);
        $this->MultiCell(90, 0, $htmBankAcc, 0, 'L', false, 0, '', '', true, 0, true, true);

        // authorize signature then new line for the final touch
		$auth = 'AUTHORIZED SIGNATURE';
		$this->SetFont('times', 'B', 11);
		$this->SetCellMargins(20, 0, 0, 0);
		$this->Cell(70, 5, $auth, 'T', 1, 'C');
    }

    // uponbank/ superceding/ inconjunction
    public function uponbank(){

        $this->Ln(5);
		$this->SetCellMargins(0, 40, 0, 0);
		$this->SetFont('courier', '', 8);
        
        // catcher for the superceding
        $result = $this->ci->sa->getsupercededsa($this->crntSA);
        
        // catcher for the inconjunction
        $incStr = implode(', SA#:', array_column($this->ci->sa->getinconjunction($this->crntSA), 'sa_no'));
        
        // Default No Inconjunction, Superceding old, Superceding New
        if($result === NULL && $incStr === '' && $incStr === NULL){
            $txt = 'Upon banking in the payment, kindly email us the bank slip for accounting purposes and to avoid unnecessary payment disputes.';
            $this->MultiCell(130, 5, $txt, 0, 'L', false, 0, '', '', true, 0, false, true);
        }
        else if($result->supercedtype == 'parent'){
           // with parent superceding (oldSA with the name of Superceded By:)
           $txt = '<span>Upon banking in the payment, kindly email us the bank slip for accounting purposes and to avoid unnecessary payment disputes.</span> <br><br><br> <span style="font-family:arial; font-weight:bold; font-size:14px;"> Superceeded By: </span>'.'<span style="font-family:arial; font-size:14px; letter-spacing:1px;" >'.'SA#:'.$result->sanum. '</span>';
            $this->MultiCell(130, 5, $txt, 0, 'L', false, 1, '', '', true, 0, true, true); 
        }
        else if($result->supercedtype == 'child'){
            // with child superceding (oldSA with the name of Superceded Cancelled:)
            $txt = '<span>Upon banking in the payment, kindly email us the bank slip for accounting purposes and to avoid unnecessary payment disputes.</span> <br><br><br> <span style="font-family:arial; font-weight:bold; font-size:14px;"> Superceeding Cancelled: </span>'.'<span style="font-family:arial; font-size:14px; letter-spacing:1px;" >'.'SA#:'.$result->sanum. '</span>';
            $this->MultiCell(130, 5, $txt, 0, 'L', false, 1, '', '', true, 0, true, true); 
        }
        else if($incStr != ''){
            $txt = '<span>Upon banking in the payment, kindly email us the bank slip for accounting purposes and to avoid unnecessary payment disputes.</span> <br><br><br> <span style="font-family:arial; font-weight:bold; font-size:14px;"> Inconjunction with: </span>'.'<span style="font-family:arial; font-size:14px; letter-spacing:1px;" >'.'SA#:'.$incStr. '</span>';
            $this->MultiCell(130, 5, $txt, 0, 'L', false, 1, '', '', true, 0, true, true); 
        }
        else{
            $txt = 'Upon banking in the payment, kindly email us the bank slip for accounting purposes and to avoid unnecessary payment disputes.';
            $this->MultiCell(130, 5, $txt, 0, 'L', false, 0, '', '', true, 0, false, true);
        }
    }
    
}

/* End of file My_pdf.php */
/* Location: ./application/libraries/My_pdf.php */
