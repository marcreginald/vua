<?php if ( ! defined('BASEPATH')) exit('No direct script allowed');

class Dashboard_model extends CI_Model{
    
    public function __construct()
    {
    
        parent::__construct();
        $this->load->helper('array');
    }
    
    # 1. TOTAL NUMBER OF THE DRAFT  VISA TRANSACTION
    public function get_drafttransac()
    {
        $q = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'DRAFT'));
        return $q->num_rows();
    }
    
    # 2. TOTAL NUMBER OF PENDING VISA TRANSACTION
    public function get_pendingtransac()
    {
        $q = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'PENDING'));
        return $q->num_rows();
    }
    
    # 3. TOTAL NUBER OF THE VERIFIED
    public function get_verifiedtransac()
    {
        $q = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'VERIFIED'));
        return $q->num_rows();
    }

    # 4. TOTAL NUMBE OF THE APPROVED TRANSACTION
    public function get_approvedtransac()
    {
        $q = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'APPROVED'));
        return $q->num_rows();
    }
    
    # 5. OUTPUT THE TRAIL OF THE transremarks_tbl output it as a json then in the view will be the parsing
    public function transac_rmk()
    {
        $crntDate = date('Y-m-d');
        
        $this->db->like('date_created', $crntDate);
        $q = $this->db->get(RMKS);  
        
        return json_encode($q->result());
    }
    
    # 6. GETTING THE ACTIVE USER FOR THE VUA
    public function vua_users()
    {
        
        $q = $this->db->get_where(USER, array('user_status' => 'active'));
        return json_encode($q->result());
    }
    
}

