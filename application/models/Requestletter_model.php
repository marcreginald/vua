<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# USER MODEL
class Requestletter_model extends CI_Model {

	#table name will be used CONSTANTS
    // creating, updating field
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}

    /* SAVING THE FINILIZE COMPOSED REQUEST LETTER */
    public function rq_draft($data)
    {
        // // custom sanitizer of data
        if(array_walk($data, 'sanitize_data')){
            
            $Q = $this->db->insert(REQS_LTR, $data);
            if((boolean)$Q){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
    }
    
    /* UPDATING THE REQUEST LETTER (NEED FURTHER IMPROVEMENT 2-20-2018)*/
    public function update_rqdraft($data, $rqlId)
    {
        
        $this->db->where('requestletter_id', $rqlId);
        $Q = $this->db->update(REQS_LTR, $data);
        if($Q){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /* DT DRAFT(REQUEST LETTER) */
    public function dt_rqdraft()
    {
        
        $Q       = $this->db->get(RQDRAFT_VIEW);
        $initial = $Q->result();
        
        if($Q->num_rows() === 0){
            return '{ "data":[] }';
        }else{
            
            $data  = [];
            $ctrNo = 0;
            
            foreach($initial as $row){
                
                $rowRQL = array();
                
                $crntBatch = $row->rq_batchnum;
                $reqNum   = $row->rq_num;
                $batchNum = $row->rq_batchnum;
                
                $rowRQL[] = '<input type="checkbox" id="rql-needle" data-rqlid='.$reqNum.'>';
                // $rowRQL[] = ++$ctrNo;
                $rowRQL[] = $reqNum;
                $rowRQL[] = '<span title="Generate Request Letter" id="btn-editdraft-rql" data-crntrql="'.$reqNum.'" data-crntbatchnum="'.$batchNum.'" class="lk-edit">'.strtoupper($crntBatch).'</span>';
                $rowRQL[] = $this->count_verifiedbatch($crntBatch);
                $rowRQL[] = $row->letter_date;
                $rowRQL[] = $row->arrival;
                $rowRQL[] = strtoupper($row->fov);
                $rowRQL[] = $row->created_by;
                $rowRQL[] = $row->last_saved;
                
                // in here the edit and print button
                // $rowRQL[] = $btnRQD;
                
                $data[] = $rowRQL;
            }
            
            return json_encode(['data' => $data]);
        }
    }
    
    /* deleting a specific request letter transaction (using rqlId)*/
    public function del_rqldraft($rqlId)
    {
        $Q = $this->db->delete(REQS_LTR, array('requestletter_id' => $rqlId));
        if($Q){
            return TRUE;
        }else{
            return FALSE;
        }        
    }
    
    /* deleting all the saved request letter in the table (deleting all)*/
    public function del_allrqldraft()
    {
        $SQL = "DELETE FROM created_requestletter WHERE rq_status = 'saved'";
        $Q = $this->db->query($SQL);
        return (boolean)$Q;
    }
    
    /* getting a specific requestLetter information */
    public function get_rqldraft($rqlId)
    {
        $Q = $this->db->get_where(REQS_LTR, array('requestletter_id' => $rqlId));
        return $Q->first_row();
    }
    
    
    /* GET ALL THE PASSPORT IMAGE OF A PARTICULAR BATCH WITH ITS TRANSACTIONS */
    public function get_batchpasspic($batchNum)
    {
        
        $this->db->select(['attached_passport']);
        $batchPassPic = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum));
        return $batchPassPic->result();
    }
    
    /* GETTING THE BOI INFORMATION BASED ON THE ID */
    public function get_boiinfo($boiId)
    {
        $Q = $this->db->get_where(BOI, array('boiprofile_id' => $boiId));
        return $Q->first_row();
    }
    
    /* GETTING THE ASSIGNATORY INFORMATION BASED ON THE REQUEST_ID */
    public function get_assiginfo($rqid)
    {
        $this->db->select(['assignatory as id']);
        $rqId = $this->db->get_where(REQS_LTR, array('requestletter_id' => $rqid));
        
        $crntRqId = $rqId->first_row()->id;
        $Q = $this->db->get_where(ASSIG, array('assignatory_id' => $crntRqId));
        return $Q->first_row();
    }
    
    /* GETTING THE BATCH TRANSACTIONS AND OUTPUT IT AS A TR */
    public function get_batchpassengerlist($batchNum)
    {
     
        //VISA_TRANSAC
        $SQL = "SELECT 
        UPPER(CONCAT(vt.va_lname,'/ ',vt.va_fname)) AS 'pass_name',
        vt.va_gender	AS 'gender',
        DATE_FORMAT(vt.va_dob, '%Y/%m/%d') AS 'dob',
        UPPER(vt.va_passportnum) AS 'passport'
        FROM visatransactions_tbl AS vt
        WHERE batch_no = ?";
        
        $Q = $this->db->query($SQL, [$batchNum]);
        $result = $Q->result();
        
        $ctr =0;
        $trList = "";
        foreach($result as $row){
            
            $ctr++;
            $tr = <<<EOT
              <tr>
                <td style="text-align:left;"> $ctr </td>
                <td style="text-align:left;"> $row->pass_name  </td>
                <td style="text-align:left;"> $row->gender </td>
                <td style="text-align:left;"> $row->dob </td>
                <td style="text-align:left;"> $row->passport </td>
            </tr>      
EOT;
            $trList .= $tr;
        }
        
        return $trList;
    }
    
    /* SAVING THE GENERATED */
    public function savegenerated_rql($rqlId, $batchNum)
    {
     
        $return = new stdClass();
        
        /* change the status of the rql to be printed */
        /* change the batch_transaction batch status => processed */
        /* change the visa transaction to become visa_transaction trans_status */
        $this->db->trans_begin();
        
        $this->db->query("UPDATE created_requestletter SET rq_status = 'printed', date_created = NOW() WHERE requestletter_id = ? ", [ $rqlId]);
        $this->db->query("UPDATE batched_trans_tbl SET batch_status = 'processed' WHERE batch_no = ? ", [$batchNum]);
        $trasac = $this->db->query("SELECT trans_no FROM visatransactions_tbl WHERE batch_no = ? ", [$batchNum]);
        
        foreach($trasac->result() as $row){
            $this->db->query("UPDATE visatransactions_tbl SET trans_status = 'PROCESSED' WHERE trans_no = ?", [$row->trans_no]);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return->status = FALSE;
            $return->rqsprint = NULL;
        }
        else
        {
            $this->db->trans_commit();
            $return->status   = TRUE;
            $return->rqsprint = $this->get_rqservicetype($rqlId); 
            // getting the ajax method call to be process (just append the request id)
        }
        
        return $return;
    }
    
    /* GETTING THE CUSTOM REQUEST LETTER LOGS */
    public function get_rqlletter($from, $to)
    {
        
        $SQL = "SELECT * FROM rqlprinted_view WHERE date_created BETWEEN ? AND ?";
        $q = $this->db->query($SQL, [$from, $to]);
        $result = $q->result();

        foreach($result as &$row){
            $row->total_records = $this->get_totalrec($row->batchnum);
        }

        if(count($result) === 0){
            return '<tr> No Data Found. </tr>';
        }else{
            
            $trList = "";
            
            foreach($result as &$row){
                
                $reqNum     = $row->rqlid;
                $batchNum   = $row->batchnum;
                $upbatchNum = strtoupper($batchNum);
                
                $trRow = <<<EOD
                    <tr>
                        <td>$reqNum</td>
                        <td>$upbatchNum</td>
                        <td>$row->total_records</td>
                        <td>$row->letter_date</td>
                        <td>$row->arrival_date</td>
                        <td>$row->fov</td>
                        <td>$row->created_by</td>
                        <td>$row->date_created</td>
                        <td><a class="btn btn-success btn-icon btn-sm" id="btn-printdraft-rql" data-crntrql="$reqNum"><i class="fa fa-print"></i></a></td>
                    </tr>   
EOD;
                
                $trList .= $trRow;
            }
            
            return $trList;
            
        }
        
    }
    
    /* DT inprocess view */
    public function dt_inprocess()
    {
        
        $Q = $this->db->get(INPROCESS_VIEW);
        $initial = $Q->result();
        
        if($Q->num_rows() === 0){
            return '{ "data":[] }';
        }else{
            
            $data  = [];
            $ctrNo = 0;
            
            foreach($initial as $row){
                
                $rowRQL = array();
                
                $crntBatch = $row->batch_no; // batch number
                $reqNum   = $row->rql_id;    // request id
                
                // $rowRQL[] = ++$ctrNo;
                $rowRQL[] = $reqNum;
                $rowRQL[] = '<span id="editdraft-rql" data-crntrql="'.$reqNum.'" class="lk-edit">'.strtoupper($crntBatch).'</span>';
                $rowRQL[] = $this->get_allapprove($crntBatch);
                $rowRQL[] = $row->letter_date;
                $rowRQL[] = $row->arrival;
                $rowRQL[] = strtoupper($row->fov);
                $rowRQL[] = $row->created_by;
                $rowRQL[] = $row->date_generated;
                
                $btnRQD = <<<EOD
                    <button class="btn btn-success btn-icon btn-sm" id="btn-printdraft-rql" data-crntrql="$reqNum" title="Print"> <i class="fa fa-print"></i> </button>
EOD;
                /*
                <button class="btn btn-icon btn-sm btn-info" title="Edit" id="btn-editdraft-rql" data-crntrql="$reqNum"> <span class="fa fa-pencil"> </span></button>
                */
                $rowRQL[] = $btnRQD;
                
                $data[] = $rowRQL;
            }
            
            return json_encode(['data' => $data]);
        }
    }
    
    /* GETTING THE RQL INFO VIA ID */
    public function getrql_info($rqlId)
    {
        
        $Q = $this->db->get_where(REQS_LTR, array('requestletter_id' => $rqlId));
        return $Q->first_row();
    }
    
    /* CHECKING IF A PARTICULAR RQL IS EXIST*/
    public function is_rqlexist($rqlId)
    {
        
        $q = $this->db->get_where(REQS_LTR, array('requestletter_id' => $rqlId));
        
        if($q->num_rows() === 1){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    /* VISA VIEW DATA REQUIREMENTS */
    /* GETTING THE BATCH SENDER */
    public function get_batchsender($rqlId)
    {
        
        /* USE STORED PROC TO GET  DATA IF ERROR REMAKE THE QUERY HERE */
        $SQL = "SELECT 
            CONCAT(usr.user_fname,'',usr.user_lname) AS 'to_agent'
        FROM created_requestletter AS rql
        INNER JOIN batched_trans_tbl AS bt
        USING(batch_no)
        INNER JOIN user_tbl AS usr
        ON bt.batch_sender = usr.user_id
        WHERE rql.requestletter_id = ?";
        
        $q = $this->db->query($SQL, [$rqlId]);
        return $q->first_row()->to_agent;
    }
    
    /* GETTINT THE (N) COLUMN VALUE BASE ON THE WHERE */
    public function lookup_rql($where, $get)
    {
        $this->db->select($get);
        $q = $this->db->get_where(REQS_LTR, $where);
        return $q->first_row()->$get; 
    }
    
    /* GETTING THE REQUEST LETTER APPLICANTS */
    public function rql_applicants($batchNum)
    {
        
        /* USING THE BATCH_NUMBER GET THE EACH TRANSACTIONS */
//        return $this->get_batchtransac($batchNum);
//        return $batchNum;
        
        $this->db->select(['id', 'va_fname as fname', 'va_lname as lname', 'va_dob as dob', 'va_gender as gender', 'va_passportnum as pass_num', 'trans_status as status', 'stampped_passport']);
        $Q = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum));
        
        return $Q->result();
    }
    
    /* GETTING THE SERVICE TYPE OF A PARTICULAR REQUEST LETTER ID */
    public function get_rqservicetype($rqlId)
    {
        
        $SQL = "SELECT bt.travel_type AS 'type' FROM created_requestletter AS rq INNER JOIN batched_trans_tbl AS bt 
        USING (batch_no) WHERE rq.requestletter_id = ?";
        
        $Q = $this->db->query($SQL, [$rqlId]);
        $type = $Q->first_row()->type;
        
        if(is_null($type)){
            die('Unable to load PDF'); // dying if it is a null value for the $type
        }else{
            
            if($type == 'airplane'){
                /* return the url for the airplane type */
                return '/vua/composerequestletter/print/';
            }else{
                /* return the url for the cruise  type */
                return '/vua/composevesselrequest/print/';
            }
            
        }
            
    }
    
    /* GETTING THE APPROVED VISA TRANSACTION IMAGES */
    public function get_imgapproved($RqlId)
    {
        /* 
            get a function that output the confirmation letter picture = (n) PDF page of each applicant stampped visa passport = (n) PDF Page
        */
        $return  = new stdClass(); // object to return along with the confirmation letter picture on it and the each of the applicant stampped visa transaction
        /* 
            $return = {
            
                stdClass Object
                (
                    [confirmation] => Array
                        (
                            [0] => 15210104770chenchen.jpg
                            [1] => 15210104771eticket.png
                        )

                    [passenger_stamppedvisa] => Array
                        (
                            [0] => Array
                                (
                                    [stampped_passport] => uploads/sample_passport.jpg
                                )

                            [1] => Array
                                (
                                    [stampped_passport] => uploads/sample_passport.jpg
                                )

                            [2] => Array
                                (
                                    [stampped_passport] => uploads/sample_passport.jpg
                                )

                        )

                )
                
            }
        */
        $this->db->select(['batch_no', 'filepath_approved_confirmationrql AS confirmation'])
            ->from('approved_rql AS approved')
            ->join('created_requestletter AS crql', 'ON approved.rql_id = crql.requestletter_id', 'inner')
            ->where('approved.rql_id', $RqlId);
        $res = $this->db->get(); 
        /* getting the batch_num and the confirmation letter here ;) */
        
        $batch_num = $res->first_row()->batch_no;
        
        $return->confirmation = explode('/', $res->first_row()->confirmation);
        
        $this->db->select(['stampped_passport']);
        $resStamppedImage = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batch_num));
        $return->passenger_stamppedvisa = $resStamppedImage->result('array');
        
        return $return;
    }
    
    /* GETTING THE STAMP PASSPORT OF THE APPROVED VISA APPLICANT */
    public function get_applicantapprovevisa($transNo)
    {
        $return = new stdClass();
        $this->db->select(['stampped_passport']);
        $res = $this->db->get_where(VISA_TRANSAC, array('trans_no' => $transNo));
        $return->confirmation = NULL;
        $return->passenger_stamppedvisa = [$res->first_row()->stampped_passport];
        
        return $return;
    }
    
/* PRIVATE METHODS */
    # RETURNING THE UPCOMING REQUEST LETTER NUMBER
    private function requestletter_logs()
    {
        $this->db->select_max('requestletter_id', 'id');
        $q = $this->db->get(REQS_LTR);
        $result = $q->first_row('array')['id'];

        return (is_null($result) ? 0 : $result);
    }    
    
    /* getting the batch_num total count of verified transaction */
    private function count_verifiedbatch($batchNum)
    {
        $batchedVerified = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum, 'trans_status' => 'VERIFIED'));
        return $batchedVerified->num_rows(); // count all the verified in a partiucular batchNumber
    }
    
    /* count the total visa transaction in one batch*/
    private function get_totalrec($batchNum)
    {
        $this->db->where_not_in('trans_status', array('JUNKED', 'PENDING'));
        $batchTotal = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum));
        return $batchTotal->num_rows(); // return an intergers of the result 
    }
    
    /* get the total number of approve in the batch*/
    private function get_allapprove($batchNo)
    {
        
        $q = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNo, 'trans_status' => 'PROCESSED'));
        return $q->num_rows();
    }
    
}


/* End of file Requestletter_model.php */
/* Location: ./application/models/Requestletter_model.php */