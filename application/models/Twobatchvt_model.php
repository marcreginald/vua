<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# BATCH TRANSAC TWO
class Twobatchvt_model extends CI_Model {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}
    
    /* selecting  just the batch information */
    public function batch_travelinfo($batchId)
    {
        
        $this->db->select(['travel_type', 'via', 'port_of_entry as poe', 'flight_or_voyagenum as fov', 'arrival as arrival_date', 'date_sent']);
        $Q = $this->db->get_where(BATCH_VT, array('batch_no' => $batchId));
        $batchInfo = $Q->first_row('array');
        
        $this->db->select(['trans_no', 'va_fname', 'va_lname', 'va_gender', 'va_dob', 'va_passportnum', 'trans_status']);
        $Q1 = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchId));
        $vtInfo     = $Q1->result();
        
        return array_merge($batchInfo, array('visainfo' => $vtInfo));
        
    }
    
    /* awesome lookup */
    public function lookupbatch($where, $get)
    {
        $this->db->select($get);
        $q = $this->db->get_where(BATCH_VT, $where);
        return $q->first_row()->$get; 
    }
    
    
    /*
        FOR DISCARDING SOME OR ALL OF THE JUNKED FILE IN THE DATABASE
    */
    /* discarding all the junked visa transaction */
    public function discardall_junked()
    {
        
        $sql = "UPDATE visatransactions_tbl SET trans_status = 'DELETED' WHERE trans_status = 'JUNKED'";
        $q = $this->db->query($sql);
        if((boolean)$q){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    /* discarding selected junked visa transaction/s */
    public function discardselected_junked($transNum)
    {
        
        $this->db->where('trans_no', $transNum);
        $q = $this->db->update(VISA_TRANSAC, array('trans_status' => 'DELETED'));
        
        if((boolean)$q){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
