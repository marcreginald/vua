<?php
defined('BASEPATH') OR exit('No direct script access allowed'); // protection

/* VUA Application native library */
class Vua_lib 
{
	public function __construct()
	{
		// get the refference for the CI object super ulta object
        $this->ci =& get_instance();
	}
    
    #input mm-dd-yyyy date
    #output iso format date
    public function isodate($dob)
    {
        $dateArr = explode('-', $dob);
        $newDob = $dateArr[2].'-'.$dateArr[0].'-'.$dateArr[1];
        return $newDob;
    }
    
    /* converting ISO Date to become a datetimepicker format */
    public function to_datetimepicker($isoDate)
    {
        $isoArr = explode('-', $isoDate);
        $dtDate = $isoArr[1].'-'.$isoArr[2].'-'.$isoArr[0];
        return $dtDate;
    }
    
    /*public function mask_printed($prtng){
        
        return 'processed';
    }*/
}

/* End of file Johnlito.php */
/* Location: ./application/libraries/Johnlito.php */

/* NOT YET IN PRODUCTION MODE NEED TOBE IMPROVED */
