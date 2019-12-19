<?php
defined('BASEPATH') OR exit('No direct script access allowed'); // protection

class My_uploader 
{
	public function __construct()
	{
		// get the refference for the CI object super ulta object
        $this->ci =& get_instance();
	}
    
    # DO THE UPLOAD
    public function ddo_upload($fileName, $newFilename ='none')
    {
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'png|jpg|jpeg|doc|docx|pdf';
        $config['max_size']      = '10000'; // 10mb
        $config['max_width']     = '10000'; // 10K width(px)
        $config['max_height']    = '10000'; // 10K height(px)
        // $config['file_type']     = 'image/jpeg';

        $this->ci->load->library('upload', $config);
        
        if ( ! $this->ci->upload->do_upload($fileName)) {
            $error = array('error' => $this->ci->upload->display_errors());
             return false;
            // return $error;
        } else {
            $data = array('upload_data' => $this->ci->upload->data());
            // unset($config['file_name']);
             return true;
            // return $data;
        }
    }
    
    # UNLINKING A FILE (working...)
    public function remove_file($fileName)
    {
        
        if(!unlink($fileName)){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    /* 
        just output the loweredversion of the passport image with its  currently extension
        and the current timestamp the passport_data has been processed 
    */
    public function format_passport($passportName, $lname, $fname, $dob, $type='_passport')
    {
        
        $changeNamed1       = str_replace('-', '', $lname.$fname.$dob);
        $changeNamed        = str_replace(' ', '', $changeNamed1);
        $passEx             = pathinfo($passportName, PATHINFO_EXTENSION); // getting the file extension
        $changePassportFile = strtolower(time().$changeNamed.$type.'.'.$passEx); // merging all
        
        return $changePassportFile;
    }
    
    /* just formatting the file name of the eticket */
    public function format_eticket($eTicketName, $tType, $arrivalDate, $via, $flightVoyage, $portEn)
    {
        
        $changeName1       = strtolower(str_replace('-', '', $tType.$arrivalDate.$via.$flightVoyage.$portEn));
        $changeName2       = str_replace(' ', '', $changeName1);
        $eticketEx         = pathinfo($eTicketName, PATHINFO_EXTENSION);
        $changeEticketName = time().$changeName2.'_eticket.'.$eticketEx;
        
        return $changeEticketName;
    }
    
     /* removing the old file then returning the new file (working)*/
    /*private function removefile($isSame, $oldFile, $newFile)
    {
        
        if($isSame === FALSE){
            $delete = UPLOADS_PATH.'\\'.$oldFile;
            $q = $this->uploader->remove_file($delete);
            if($q){
                return 'uploads/'.$newFile;
            }else{
                return 'uploads/'.$oldFile;
            }
            
        }else{
            return 'uploads/'.$oldFile;
        }
    }*/
}

/* End of file Johnlito.php */
/* Location: ./application/libraries/Johnlito.php */

/* NOT YET IN PRODUCTION MODE NEED TOBE IMPROVED */
