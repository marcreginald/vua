<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Downloadvisaimg extends CI_Controller {
    
    /* downloading the stampped passport or individual visa stampped */
    public function down($rqlId=0, $transNum=''){
        
        set_time_limit(0);
        ini_set('memory_limit', '-1'); // setting the memory limit to unlimited
        
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
            $this->down_visa->Imagegenerator('', $transNum);
        }
        
        $this->down_visa->Output('download.pdf', 'I');
        
    }
    
}
    