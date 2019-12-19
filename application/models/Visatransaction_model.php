<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# USER MODEL
class Visatransaction_model extends CI_Model {

	#table name will be used CONSTANTS
    private  $visatransacf = array('trans_no', 'va_lname', 'va_fname', 'va_dob', 'va_gender', 'va_passportnum', 'attached_passport', 'created_by');
    
    # edit fields (noPicture)
    private $visatransedit = array('va_lname', 'va_fname', 'va_dob', 'va_gender', 'va_passportnum');
    
    # edit fields (withPic)
    private $visatranseditwpic = array('va_lname', 'va_fname', 'va_dob', 'va_gender', 'va_passportnum', 'attached_passport');
    
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}
    
    /* CREATING NEW TRANSACTION */
    public function new_transaction($post)
    {
        
        $transId     = $this->get_lasttransid() + 1;
        $nextTransNo = 'trans-'.$transId;
        
        $inertClientInfo = $this->db->insert(VISA_TRANSAC, elements($this->visatransacf, array_merge($post, array('trans_no' => $nextTransNo))));
        
        $remarksDat = array(
            'trans_no'      => $nextTransNo,
            'remarks_by'    => $post['created_by'],
            'remarks_type'  => 'DRAFT',
            'description'   => 'DRAFTED'
            //'description' => $post['description']

        );
        
        $insertRemarks = $this->db->insert(RMKS, $remarksDat);
        return (boolean)$insertRemarks;
        
    }
    
    /* UPDATING EXISTING TRANSACTION (old update_attached passport with eticket_image)*/
    /* must revised: 9:57 AM 3/5/2018 */
    public function update_transaction($post)
    {
        /*  && isset($post['attached_eticket']) */
        if(isset($post['attached_passport'])){
            
            $this->db->where('id', $post['trans_id']);
            $this->db->where('trans_no', $post['trans_no']);
            $q = $this->db->update(VISA_TRANSAC, elements($this->visatranseditwpic, $post));
            return (boolean)$q; 
            
        }else{
           $this->db->where('id', $post['trans_id']);
            $this->db->where('trans_no', $post['trans_no']);
            $q = $this->db->update(VISA_TRANSAC, elements($this->visatransedit, $post));
            return (boolean)$q; 
        }   
    }
    
    /* VERIFYING A VISA TRANSACTION */
    public function verified_transac($transNum, $verifierId)
    {
        $verificationStat = 'VERIFIED';
        $changeStat       = $this->change_transstatus($transNum, $verificationStat, $verifierId);
        
        $verifyDat = array(
            'trans_no' => $transNum,
            'verified_by' => $verifierId   
        );
        // saving the info in verifying_visatransac tbl
        $insertVerify     = $this->db->insert(VERIFY_TBL, $verifyDat);
        return (boolean)$changeStat && (boolean)$insertVerify;
    }
    
    /* JUNKING A VISA TRANSACTION */
    public function junking_transac($transNum, $junkBy)
    {
        $junkStat   = 'JUNKED';
        $changeStat = $this->change_transstatus($transNum, $junkStat, $junkBy);
        return (boolean)$changeStat;
    }
    
    /* CHECKING IF THE SPECIFIED FILE ALREADY EXIST IN THE /uploads/ via (db) */
    public function is_fileexist($fileName)
    {
        
        $fName = "uploads/".$fileName;
        $this->db->or_where(array('attached_passport' => $fName, 'attached_eticket' => $fName));
        $q=$this->db->get(VISA_TRANSAC);
        
        if($q->num_rows() >= 1){
            // return 'di pwedi mag in';
            return FALSE;
        }else{
            // return 'pwedi mag in';
            return TRUE;
        }
    }
    
    /* MARKING A TRANSACTION AS A DISCARDED ONE */
    public function change_transstatus($transNum, $status, $markedBy, $customRmks = 'none')
    {
        
        $this->db->set('trans_status', $status);
        $this->db->where('trans_no', $transNum);
        $q = $this->db->update(VISA_TRANSAC);
        
        /*do the remarks logging here */
        if((boolean)$q){
            
            $rmkData = array(
                'trans_no'    => $transNum,
                'remarks_by'  => $markedBy,
                'remarks_type'=> strtoupper($status),
                'description' => strtoupper(($customRmks === 'none' ? $status : $customRmks))
            );
            
            $qRmks = $this->db->insert(RMKS, $rmkData);
            return(boolean)$qRmks;
        }
    }
    
    /* DISCARDING USER BASED VISA TRANSACTION (SIMPLY TAGGING THE VISA TRANSACTION TO DELETED AND LOGGING SOME DATA)*/
    public function discarduser_draft($userId)
    {
        
        $disCardStatus = 'DELETED';
        
        $this->db->where('created_by', $userId);
        $this->db->where('trans_status', 'draft');
        $q = $this->db->update(VISA_TRANSAC, array('trans_status' => $disCardStatus));
        
        return (boolean)$q;
    }
    
    /* GETTING THE CURRENT VISA TRANSACTION STATUS */
    public function get_currstatus($transNo)
    {
        
        $this->db->select('trans_status');
        $Q = $this->db->get_where(VISA_TRANSAC, array('trans_no' => $transNo));
        return $Q->first_row();
    }
    
    /* (DT) SHOWING THE AGENT DRAFTED VISA TRANSACTIONS */
    public function agent_draftedtransactions($agentId)
    {
        
        $agentDraft = $this->db->query("CALL agentDraft(?)", [$agentId]);
        $result = $agentDraft->result();
        
        if($agentDraft->num_rows() === 0){
            return '{ "data": [] }';
        }else{
            $data = [];
            $ctrNo = 0;
            
             foreach ($result as $row) {
                $row_trans = array();

                    $row_trans[] = '<input type="checkbox" id="trans-needle" data-transnum='.$row->trans_no.'>';
                    $row_trans[] = $ctrNo = ($ctrNo + 1);
                    $row_trans[] = '<a href="javascript:;" style="text-transform:uppercase;"id="transcol" data-transnum='.$row->trans_no.'>'.$row->trans_no.'</a>';
                    $row_trans[] = $row->fullname;
                    $row_trans[] = $row->gender;
                    $row_trans[] = $row->birthdate; //used SA
                    $row_trans[] = strtoupper($row->passport);
                    $row_trans[] = $row->created;

                    $data[] = $row_trans;
             }
            return json_encode(['data' => $data]);
        }
    }
    
    /* (OBJ) GETTING AN SPECIFIC TRANSACTION VIA TRANS_ID */
    public function get_transdata($transNo)
    {

        $q = $this->db->get_where(VISA_TRANSAC, array('trans_no' => $transNo));
        return $q->first_row();
    }
    
    /* GETTING ALL AGENT DRAFTED TRANSACTION */
    public function all_draftedagent($agentId)
    {
        $agentDraft = $this->db->query("CALL agentDraft(?)", [(int)$agentId]);
        return $agentDraft->result();
    }
    
    /* GETTING ALL THE PENDING STATUS */
    public function inbox_view($transStatus)
    {
        $Q = $this->db->get_where(INBOX_VIEW, array('trans_status' => strtoupper($transStatus)));
        $result = $Q->result();
        
        if($Q->num_rows() === 0){
            return '{ "data": [] }';
        }else{
            $data = [];
            $ctrNo = 0;
            
             foreach ($result as $row) {
                $row_td = array();

                    $row_td[] = '<input type="checkbox" id="trans-needle" data-transnum='.$row->trans_no.' data-batchnum='.$row->batch_no.'>';
                    $row_td[] = $ctrNo = ($ctrNo + 1);
                    $row_td[] = '<a href="javascript:;" style="text-transform:uppercase;"id="transcol" data-transnum='.$row->trans_no.'>'.$row->trans_no.'</a>';
                    $row_td[] = $row->arrival;
                    $row_td[] = strtoupper($row->batch_no);
                    $row_td[] = $row->sender;
                    $row_td[] = $row->full_name;
                    $row_td[] = $row->gender;
                    $row_td[] = strtoupper($row->passport); //used SA
                    $row_td[] = strtoupper($row->fov_num);
                    $row_td[] = $row->trans_status;
                    $row_td[] = $row->date_sent;
                    $data[]   = $row_td;
             }
            
            if($transStatus === 'pending'){
                
                foreach($data as &$transac){
                    array_splice($transac, 0, 1);
                }
                return json_encode(['data' => $data]);
                
            }else{
                return json_encode(['data' => $data]);
            }
        }
    }
    
    /* DATATABLE OF THE JUNKED PAGE */
    public function junked_view()
    {
        $Q = $this->db->get(JUNKED_VIEW);
        $result = $Q->result();

        if($Q->num_rows() === 0){
            return '{ "data": [] }';
        }else{
            
            $data = [];
            $ctrNo = 0;
            
             foreach ($result as $row) {
                $row_td = array();

                    $row_td[] = '<input type="checkbox" id="trans-needle" data-transnum='.$row->trans_no.'>';
                    // $row_td[] = $ctrNo = ($ctrNo + 1);
                    // $row_td[] = '<a href="javascript:;" style="text-transform:uppercase;"id="transcol" data-transnum='.$row->trans_no.'>'.$row->trans_no.'</a>';
                    $row_td[] = $row->trans_no;
                    $row_td[] = $row->fullname;
                    $row_td[] = $row->gender;
                    $row_td[] = $row->dob; //used SA
                    $row_td[] = $row->passport;
                    $row_td[] = $row->fov;
                    $row_td[] = $row->arrival;
                    $row_td[] = $row->date_created;
                 
                    $data[] = $row_td;
             }
            return json_encode(['data' => $data]);
        }
    }
    
    /* CHECKING IF THE @param trans-no is exist or not */
    public function isvt_exist($trans_no)
    {
        $Q = $this->db->get_where(VISA_TRANSAC, array('trans_no' => $trans_no));
        
        if($Q->num_rows() === 1){
            return TRUE;
        }else{
            return FALSE;
        }

    }
    
    /* GETTING THE BATCH-NUMBER OF A SPECIFIC VISA TRANSACTION */
    public function get_vtbatchnum($trans_no)
    {
        $this->db->select('batch_no');
        $q = $this->db->get_where(VISA_TRANSAC, array('trans_no' => $trans_no));
        $batchNUm = $q->first_row()->batch_no;
        
        // update the batchrequest_tbl
        $this->db->where('batch_no', $batchNUm);
        $q1 =$this->db->update(BATCH_RQLLOGS, array('batchrequest_stat' => 'read'));
        return (boolean)($q && $q1);
    }

    /* getting all the pending batched status for the notification in the right sidebar */
    
    /* new transaction */
    private function get_lasttransid()
    {
        
        $this->db->select_max('id');
        $q = $this->db->get(VISA_TRANSAC);
        $result = $q->first_row('array')['id'];

        return (is_null($result) ? 0 : $result);
    }
    
}


/* End of file Visatransaction_model.php */
/* Location: ./application/models/Visatransaction_model.php */