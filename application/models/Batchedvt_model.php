<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# NAME MODEL
class Batchedvt_model extends CI_Model {

	# table name will be used CONSTANTS
    # declare fields here
    //BATCH_VT
    //RMKS
    //VISA_TRANSAC
    //USER

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}
    
    # UPDATED VERSION FOR THE VISA SAVE SEND PROCEDURE (HANDLE MULTIPLE ETICKET FILE JUST DELIMTED BY THE & CHARACTER)
    public function sendsavebatch($post, $selectedTrans, $cookieId, $eticketName)
    {
        
        $batch_id  = $this->get_lastbatchid() + 1;
        $batch_no  = 'batch-'.$batch_id;
        $sender_id = $cookieId;
        
        $newPost = array(
            'batch_no'   => $batch_no,
            'arrival'    => $this->vua_lib->isodate($post['arrival']),
            'travel_type'=> $post['travel_type'],
            'via'        => $post['via'],
            'flight_or_voyagenum' => $post['flight_or_voyagenum'],
            'port_of_entry'       => $post['port_of_entry'],
            'attached_eticket'    => $eticketName,
            'batch_sender'        => $sender_id
        );
        
        $insertBatch = $this->db->insert(BATCH_VT, $newPost); // inserting in the (batched_trans_tbl) 
        
        $batchRequestDat = array(
            'sender_id'        =>$sender_id,
            'batch_no'         =>$batch_no,
            'batchrequest_stat'=>'new'
        );
        
        
        if($insertBatch){
            
            // inserting in the batch_requestlog
            $insertBatchLog = $this->db->insert(BATCH_RQLLOGS, $batchRequestDat);
            
            $selected = $selectedTrans;
            $transNum = "";
            $q = FALSE;
            for($i=0, $ln=count($selected); $i<$ln; $i++){
                
                $this->db->where('trans_no', $selected[$i]);
                $q = $this->db->update(VISA_TRANSAC, array('batch_no' => $batch_no));
                
                $q1 = $this->change_stats($selected[$i], 'PENDING', $sender_id);
            }
            return (boolean)($q && $q1);
            
        }else{
            return FALSE;
        }
    }
    
    # SAVE AND SEND VISA TRANSACTIONS / TRANSACTION (old) 8:58 AM 3/6/2018
    public function sendsavebatch_old($post, $selectedTrans, $cookieId)
    {
        
        $batch_id  = $this->get_lastbatchid() + 1;
        $batch_no  = 'batch-'.$batch_id;
        $sender_id = $cookieId;
        
        $newPost = array(
            'batch_no'   => $batch_no,
            'arrival'    => $this->vua_lib->isodate($post[1]['value']),
            'travel_type'=> $post[0]['value'],
            'via'        => $post[2]['value'],
            'flight_or_voyagenum' => $post[3]['value'],
            'port_of_entry' => $post[4]['value'],
            'batch_sender' => $sender_id
        );
        
        $insertBatch = $this->db->insert(BATCH_VT, $newPost); // inserting in the (batched_trans_tbl) 
        
        $batchRequestDat = array(
            'sender_id'        =>$sender_id,
            'batch_no'         =>$batch_no,
            'batchrequest_stat'=>'new'
        );
        
        
        if($insertBatch){
            
            // inserting in the batch_requestlog
            $insertBatchLog = $this->db->insert(BATCH_RQLLOGS, $batchRequestDat);
            
            $selected = $selectedTrans;
            $transNum = "";
            $q = FALSE;
            for($i=0, $ln=count($selected); $i<$ln; $i++){
                
                $this->db->where('trans_no', $selected[$i]);
                $q = $this->db->update(VISA_TRANSAC, array('batch_no' => $batch_no));
                
                $q1 = $this->change_stats($selected[$i], 'PENDING', $sender_id);
            }
            return (boolean)($q && $q1);
            
        }else{
            return FALSE;
        }
    }
    
    # GETTING A SPECIFIC VISA TRANSACTION WITH ITS BATCH_INFO
    public function get_batchtransdata($transId)
    {
        $Q = $this->db->query("CALL transacInfo(?)", [$transId]);
        return $Q->first_row();
    }
    
    /* REGROUPING A VISA TRANSACTION (CHANGING ITS BATCH NUMBER) */
    public function regroup_vt($isAll = FALSE, $transNumArr, $selectedGrp, $regroupBy)
    {
        $status      = 'REGROUP';
        $Q           = TRUE;
        $Q1          = TRUE;
        
        $mrksDat = array(
            'remarks_by'  => $regroupBy,
            'remarks_type'=> 'REGROUP',
            'description' => 'Regrouping'
        );
        
        if($isAll){
            
            $allPendings = $this->all_verified();
            foreach($allPendings as $row){
                $this->db->where('trans_no', $row->trans_no);
                $Q  &= $this->db->update(VISA_TRANSAC, array('batch_no' => $selectedGrp));
                $Q1 &= $this->db->insert(RMKS, array_merge($mrksDat, array('trans_no' => $row->trans_no)));
            }
            
            return ($Q && $Q1); 
        }else{
            
            for($i=0, $ln=count($transNumArr); $i<$ln; $i++){
                $this->db->where('trans_no', $transNumArr[$i]);
                $Q  &= $this->db->update(VISA_TRANSAC, array('batch_no' => $selectedGrp));
                $Q1 &= $this->db->insert(RMKS, array_merge($mrksDat, array('trans_no' => $transNumArr[$i])));
            }
            
            return ($Q && $Q1);
        }
    }
    
    /* get the initial here or maybe use these as the base ahha */
    public function all_batchrecords($agentId = 0)
    {
        $BatchList = $this->db->get(BATCH_VIEW);
        
        $result    = $BatchList->result();
        
        if($BatchList->num_rows() === 0){
            return '{ "data": [] }';
        }else{
            
            $data  = [];
            $ctrNo = 0;
            
            foreach($result as &$row){
                $rowBatch = array();
                
                $isComplete = $this->isbatch_complete($row->batch_no);
                $smBatchNum = $row->batch_no;
                
                $rowBatch[] = ++$ctrNo;
                $rowBatch[] = '<span class="lk-edit" id="mgr-previewbatch" data-batchid="'.$row->batch_no.'">'.strtoupper($smBatchNum).'</span>';
                $rowBatch[] = $row->sender;
                $rowBatch[] = $row->date_sent;
                $rowBatch[] = $this->get_countbybatchednum($row->batch_no); // total records 
                $rowBatch[] = $this->get_batchedpendings($row->batch_no); // pendings
                $rowBatch[] = $this->get_countverifiedbybatchednum($row->batch_no); // verified
                $rowBatch[] = $isComplete; // complete or incomplete
                
                $btnView = "";
                if($isComplete == 'complete'){
                    $btnView = <<<EOD
                    <button class="btn btn-info btn-icon btn-sm" title="Compose batch request letter" id="mgr-composeltter" data-batchid="$row->batch_no">Compose Batch Request Letter</button> 
EOD;
                }else{
                    $btnView = <<<EOD
                    &nbsp;
EOD;
                }
                $rowBatch[] = $btnView;
                
                $data[] = $rowBatch;
            }
            
            return json_encode(['data' => $data]);
            
        }
    }
    
    /* getting the list of transaction in one batched records */
    public function get_batchtransac($batchNum)
    {
        // $Q = $this->db->query("CALL getTransacInfoBybatchNum(?)", [$batchNum]);
        $SQL = "SELECT
        usr.user_profilepath AS 'senderpic',
        DATE_FORMAT(bt.date_sent, '%b. %d, %Y %l:%i %p') AS 'date_sent',
        CONCAT(usr.user_fname,' ',usr.user_lname) AS 'sender_name',
        usr.user_email 	 AS 'sender_email',
        vt.id 	     AS 'trans_id',
        vt.trans_no  AS 'trans_no',
        bt.batch_id  AS 'batch_id',
        bt.batch_no  AS 'batch_no',
        vt.va_lname  AS 'lname',
        vt.va_fname  AS 'fname',
        vt.va_gender AS	'gender',
        DATE_FORMAT(vt.va_dob, '%b. %d, %Y') AS 'dob',
        UPPER(vt.va_passportnum) AS 'passportnum',
        vt.attached_passport AS 'passport_pic',
        DATE_FORMAT(bt.arrival, '%b. %d, %Y') AS 'arrival',
        bt.via		AS 'via',
        UPPER(bt.flight_or_voyagenum) AS 'fov',
        bt.port_of_entry AS 'poe',
        bt.travel_type AS 'travel_type',
        vt.trans_status AS 'trans_stat',
        bt.attached_eticket AS 'eticket_pic'
        FROM visatransactions_tbl AS vt
        INNER JOIN batched_trans_tbl AS bt
        USING(batch_no)
        INNER JOIN user_tbl AS usr
        ON bt.batch_sender = usr.user_id
        WHERE vt.batch_no = ? AND trans_status IN('PENDING', 'VERIFIED')";
        
        /*
          edit: 10:37 AM 3/6/2018
          remove the e-ticket (        vt.attached_eticket AS 'eticket_pic',)
        */
        
        $Q = $this->db->query($SQL, [$batchNum]);
        return $Q->result();
    }
    /* updated on 12:59 PM 2/15/2018  cause was the batch record including of junked  setting the return status explicitly to (VERIFIED, PENDING)*/
    
    /* pdf letter body information */
    public function get_pdfbatchtransac($batchNum)
    {
        $this->db->select(['arrival', 'flight_or_voyagenum as fov', 'port_of_entry as poe', 'via', 'attached_eticket']);
        $Q = $this->db->get_where(BATCH_VT, array('batch_no' => $batchNum));
        return $Q->result();
    }
    
    /* compose edit custom tranac list */
    public function get_composeditlistapplicant($batchNum)
    {
        $SQL = "SELECT 
        va_fname AS 'fname',
        va_lname AS 'lname',
        va_gender AS 'gender',
        DATE_FORMAT(va_dob, '%b. %d, %Y') AS 'dob',
        va_passportnum AS 'passportnum',
        trans_status AS 'trans_stat'
        FROM visatransactions_tbl 
         WHERE batch_no = ?";
        $Q = $this->db->query($SQL, [$batchNum]);
        return $Q->result();
    }
    
    public function get_batchinfo($batchNum)
    {
        $q = $this->db->get_where(BATCH_VT, array('batch_no' => $batchNum));
        return $q->first_row();
    }

    /* just checking if a batch_no exist or not*/
    public function isbt_exist($batchNo)
    {
        $Q = $this->db->get_where(BATCH_VT, array('batch_no' => $batchNo));

        if($Q->num_rows() === 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function get_batch_eticket_names($batchNum)
    {
        $return = new stdClass();
        $this->db->select(['attached_eticket as etickets', 'via', 'flight_or_voyagenum']);
        $q = $this->db->get_where(BATCH_VT, array('batch_no' => $batchNum));
        
        
        $q1 = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum)); // getting the total pax in a particular batch
        $totalPax = $q1->num_rows(); // getting the total number of the pax in the current batch
        $row = $q->first_row();
        
        $return->etickets = $row->etickets;
        $viaFlight = str_replace(' ', '', $row->via.$row->flight_or_voyagenum);
        $return->zipname = $totalPax.'pax_'.$viaFlight;
        
        return $return;
    }
    
/* SOME PRIVATE METHODS HERE */
    private function get_batchnum()
    {
        $this->db->select('batch_no');
        $this->db->order_by('batch_no', 'DESC');
        $qLastId   = $this->db->get(BATCH_VT);
        
        $crntLast  = $qLastId->first_row('array')['batch_no'];
        
        $crntNum   = explode('-', $crntLast);
        
        $idxNum = ($crntNum[0] === '') ? 0 : $crntNum[1];
        $nextTrans = $idxNum + 1;
        
        return 'batch-'.$nextTrans;
    }

    #$transNum, $status, $markedBy, $customRmks = 'none'
    private function change_stats($transNum, $status, $markedBy, $customRmks = 'none')
    {
        $CI =& get_instance();
        $CI->load->model('visatransaction_model', 'vt');
        return $this->vt->change_transstatus($transNum, $status, $markedBy, $customRmks);
    }
    
    /* returning the last id from the batch table */
    private function get_lastbatchid()
    {
        
        $this->db->select_max('batch_id');
        $q = $this->db->get(BATCH_VT);
        $result = $q->first_row('array')['batch_id'];

        return (is_null($result) ? 0 : $result);
    }
    
    /* getting all th e visa transaction whos type in pending */
    private function all_pendings()
    {
        $this->db->select(['id as trans_id', 'trans_no']);
        $allPending = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'PENDING'));
        return $allPending->result();

    }
    
    /* getting all th e visa transaction whos type in verified */
    private function all_verified()
    {
        $this->db->select(['id as trans_id', 'trans_no']);
        $allPending = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'VERIFIED'));
        return $allPending->result();

    }
    
    /* ouput the total number of visa transaction in a particular batchNumber */
    private function get_countbybatchednum($batchNum)
    {
        $this->db->where_not_in('trans_status', array('JUNKED', 'PROCESSED'));
        $batchTotal = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum));
        return $batchTotal->num_rows(); // return an intergers of the result 
    }
    
    /* returning the number of all the counted verified visa transaction in a particular batchNumber */
    private function get_countverifiedbybatchednum($batchNum)
    {
        $batchedVerified = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum, 'trans_status' => 'VERIFIED'));
        return $batchedVerified->num_rows(); // count all the verified in a partiucular batchNumber
    }
    
    /* returning all the pending in a particular batch_number */
    private function get_batchedpendings($batchNum)
    {
        
        $Q = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum, 'trans_status' => 'PENDING'));
        return $Q->num_rows(); // return the number of the pending in a particular batch_number
    }
    
    /* setting if the batched is now complete with the get_countbybatchednum and get_countverifiedbybatchednum (void but it have a parameter) */
    private function isbatch_complete($batchNum)
    {
        
        $all        = $this->get_countbybatchednum($batchNum);
        $verified   = $this->get_countverifiedbybatchednum($batchNum);
        if($all == $verified){
            $Q = $this->db->query("UPDATE batched_trans_tbl SET batch_status = 'complete' WHERE batch_no = ?", [strtoupper($batchNum)]);
            $this->db->reset_query();
            return 'complete';
        }else{
            return 'incomplete';
        }
        
                
    }
    
}


/* End of file Batchedvt_model.php */
/* Location: ./application/models/Batchedvt_model.php */
