<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# USER MODEL
class User_model extends CI_Model {

	#table name will be used CONSTANTS
    // USER
    private $userfields = array('user_email', 'user_pass', 'user_type', 'user_lname', 'user_fname', 'user_branch', 'created_by');
    private $usereditfields = array('user_email', 'user_type', 'user_lname', 'user_fname', 'user_branch', 'user_status');
    private $salty = '0394';
    
   /* private $popsenderbtn_row = function ($row){
        unset($row[1]);
        unset($row[7]);
    };*/
    
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}
    
    # DT PAYLOAD FOR THE SYSTEM USER
    public function dt_userlist()
    {
        
        $q = $this->db->get(USER);
        
        $users = $q->result();
        
        if($q->num_rows() === 0){
            return '{ "data":[] }';
        }else{
            
            $data  = [];
            $ctrNo = 0;
            
            foreach($users as $user){
                
                $rowUser = array();
                
                // $rowRQL[] = '<input type="checkbox" id="rql-needle" data-rqlid='.$reqNum.'>';
                $rowUser[] = ++$ctrNo;
                $rowUser[] = ucwords($user->user_fname);
                $rowUser[] = ucwords($user->user_lname);
                $rowUser[] = strtolower($user->user_email);
                $rowUser[] = ucfirst($user->user_type);
                $rowUser[] = ucfirst($user->user_branch);
                $rowUser[] = strtolower($user->user_status);
                
                $btnEdit = <<<JL
                    <button class="btn btn-sm btn-info" id="edit-user" data-userid="$user->user_id"> <span class="fa fa-edit"> </span> Edit </button>
JL;
                
                $rowUser[] = $btnEdit;
                
                // in here the edit and print button
                // $rowRQL[] = $btnRQD;
                
                $data[] = $rowUser;
            }
            
            return json_encode(['data' => $data]);
        }
        
    }
    
    #CREATION OF NEW USER
    public function create_user($post, $createdBy)
    {
        
        $encrpPass = $this->encryptpass($post['user_pass']);
        unset($post['user_pass']);
        
        $updatedPost = array_merge($post, array('user_pass' => $encrpPass, 'created_by' => $createdBy));
        // array_walk(updatedPost, sanitize_data);
        $q = $this->db->insert(USER, elements($this->userfields, $updatedPost));
        return (boolean)$q;
        
    }
    
    # GETTING SINGLE USER INFO
    public function get_userinfo($userId){
        $userInfo = $this->db->get_where(USER, array('user_id' => $userId));
    
        return $userInfo->first_row();
    }
    
    # UPDATING THE SYSTEM USER
    public function update_user($post)
    {
        
        $this->db->where('user_id', $post['user_id']);
        $q = $this->db->update(USER, elements($this->usereditfields, $post));
        return (boolean)$q;
    }
    
    # VALIDATING USER CREDENTIALS
    public function validate($userEmail, $userPass)
    {

        $encPass = crypt($userPass, '0394');
        $SQL = "SELECT * FROM vua_db.user_tbl WHERE user_email = ? AND user_pass = ?";
        $userData = $this->db->query($SQL, [$userEmail, $encPass]);
        
        return $userData->first_row();
        
    }
    
    
    #ACTIVATING  / DEACTIVATING USER ACCOUNT (currently not in used ); 
    public function change_userstat($userId, $userStatus)
    {
        $this->db->set('user_status', $userStatus);
        $this->db->where('user_id', $userId);
        $updateUser = $this->db->update(USER);
        return (boolean)$updateUser;
        
    }
    
    /* return of number of pendings */
    public function num_pendings()
    {
        $q = $this->db->get_where(VISA_TRANSAC, array('trans_status' => 'pending'));
        return $this->db->affected_rows();
    }
    
    /*AGENT SENT VISA TRANSACTION VIEW (WRONG HAHA SO WHAT I HAVE A DT FOR THESE PARTICULAR SCENARIO)*/
    public function user_sentview_transactiontype($agentId)
    {
        
        $Q = $this->db->get_where(INBOX_VIEW, array('sender_id' => $agentId));
        $result    = $Q->result();
        

        if($Q->num_rows() === 0){
            return '{ "data": [] }';
        }else{
            $data = [];
            $ctrNo = 0;
            
             foreach ($result as $row) {
                $row_td = array();

                    $row_td[] = $ctrNo = ($ctrNo + 1);
                    $row_td[] = '<a href="javascript:;" style="text-transform:uppercase;"id="transcol" data-transnum='.$row->trans_no.'>'.$row->trans_no.'</a>';
                    $row_td[] = strtoupper($row->batch_no);
                    $row_td[] = $row->full_name;
                    $row_td[] = $row->gender;
                    $row_td[] = strtoupper($row->passport); //used SA
                    $row_td[] = $row->arrival;
                    $row_td[] = strtoupper($row->fov_num);
                    $row_td[] = $row->trans_status;
                    $row_td[] = $row->date_sent;
                 
                    $data[]   = $row_td; // allocating indexes to the data[] assigned via $row_data(indexed_array)
             }
             return json_encode(['data' => $data]);
//            return ['data' => $data];
        }
    }
    
    /* user sent batch visa transaction (old wrong)*/
    public function user_sentbacthview_old($agentId)
    {
        $resJSON = $this->bt_agentbatchrecsent($agentId);
        
        $resJSON = json_decode($resJSON); // decoding the json data
        
        $rows = $resJSON->data;
        
        if(count($rows) === 0){
            return '{ "data": [] }';
        }else{
            
            $data = []; // array literal
            
            for($i=0, $ln=count($rows); $i<$ln; $i++){
                array_splice($rows[$i], 1, 1);
                array_splice($rows[$i], -1, 1);

                $batchnum = strtolower($rows[$i][0]);
                $btnViewBatch = <<<EOD
                 <button class="btn btn-lime btn-icon btn-sm" style="margin-left: 25%;" title="View batch transactions" id="agent-previewbatch" data-batchid="$batchnum"><i class="fa fa-eye"></i></button>       
EOD;
                array_push($rows[$i], $btnViewBatch);
                
                // $data[] = $rows;
                array_push($data, $rows[$i]);
            }

            return json_encode(['data' => $data]);
            
        }
    }
    
    /* USER BASE SENT BATCH */
    public function user_sentbacthview($agentId)
    {
        
         $initial = $this->db->get_where(AGENT_SENTBATCH_VIEW, array('sender_id' => $agentId));
        
        $result  = $initial->result();
        
        if($initial->num_rows() === 0){
            return '{ "data": [] }';
        }else{
            
            $data  = [];
            $ctrNo = 0;
            
            foreach($result as &$row){
                $rowBatch = array();
                
                
                $batchNum = $row->batch_no;
                $where = array('batch_no' => $batchNum);
                $rowBatch[] = ++$ctrNo;
                $rowBatch[] = '<span id="agent-previewbatch" data-batchid="'.$batchNum.'" class="lk-edit">'.strtoupper($batchNum).'</span>';
                // $rowBatch[] = $row->sender;
                $rowBatch[] = $this->get_colbatch($where, 'travel_type');
                $rowBatch[] = $this->get_colbatch($where, 'arrival'); // ARRIVAL
                $rowBatch[] = $this->get_colbatch($where, 'via'); // VIA/ TRAVEL TYPE
                $rowBatch[] = $this->get_colbatch($where, 'flight_or_voyagenum'); // FLIGHT NUMBER
                $rowBatch[] = $row->date_sent;
                $rowBatch[] = $row->batch_status;
                
                $data[] = $rowBatch;
            }
            
            return json_encode(['data' => $data]);
        }
    }
    
    /* GETTING EMAIL AND FULL NAME OF A PARTICULAR USER */
    public function get_emailfname($userId)
    {
        
        $return = new stdClass();
        $this->db->select(['user_email as email', 'user_fname as fname', 'user_lname as lname', 'user_profilepath as profilepic']);
        $q = $this->db->get_where(USER, array('user_id' => $userId));
        
        $fullName = $q->first_row()->fname.$q->first_row()->lname;
        $return->fullname = $fullName;
        $return->email    = $q->first_row()->email;
        $return->profile  = $q->first_row()->profilepic;
        
        return $return;
        
    }

    
/* PRIVATE METHODS */
    
    #ENCRYPTING USER PASSWORD
    private function encryptpass($pass)
    {
        return crypt($pass, $this->salty);
        echo '$pass';
    }
    
    #GETTING THE COLUMN  VALUE BASED IN THE WHERE
    private function get_colbatch($where, $get)
    {
        
        $CI =& get_instance();
        $CI->load->model('twobatchvt_model', 'tbt');
        return $this->tbt->lookupbatch($where, $get);
        
    }

}


/* End of file User_m.php */
/* Location: ./application/models/User_m.php */

/*
 transaction :) 
    $this->db->trans_begin();

$this->db->query('AN SQL QUERY...');
$this->db->query('ANOTHER QUERY...');
$this->db->query('AND YET ANOTHER QUERY...');

if ($this->db->trans_status() === FALSE)
{
        $this->db->trans_rollback();
}
else
{
        $this->db->trans_commit();
}
*/