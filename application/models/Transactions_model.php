<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# TRANSACTIONS MODEL
class Transactions_model extends CI_Model {
    
    protected $sqlbase = "
    SELECT 
	UPPER(vt.trans_no) AS 'trans_no',
	UPPER(bt.batch_no) AS 'batch_no',
	LOWER(CONCAT(vt.va_fname,' ',vt.va_lname)) AS 'full_name',
	vt.va_gender AS 'gender',
	UPPER(vt.va_passportnum) AS 'passport',
	DATE_FORMAT(bt.arrival, '%m-%d-%Y') AS 'arrival',
	UPPER(bt.flight_or_voyagenum) AS 'fov_num',
	LOWER(vt.trans_status) 	   AS 'trans_status'
		
	FROM visatransactions_tbl AS vt
	INNER JOIN batched_trans_tbl AS bt
	USING(batch_no)
    ";
    
    # CONSTRUCTOR
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}
    
    # GETTING TRASACTIONS 
    public function get_transacs($from, $to, $type)
    {
        $cFrom = $this->vua_lib->isodate($from);
        $cTo   = $this->vua_lib->isodate($to);

        $all      = "WHERE vt.trans_status NOT IN('JUNKED', 'DELETED') AND bt.arrival BETWEEN ? AND ?";
        $typebase = "WHERE vt.trans_status = ? AND bt.arrival BETWEEN ? AND ?";
        
        $result = NULL;
        
        if($type == 'all'){
            $Q = $this->db->query($this->sqlbase.$all, [$cFrom, $cTo]);
            $result = $Q->result();
        }else{
            $Q = $this->db->query($this->sqlbase.$typebase, [$type, $cFrom, $cTo]);
            $result = $Q->result();
        }
        
        if(count($result) === 0){
            return 'No data found';
        }else{
            $trList = "";
            $ctr    = 0;
            
                foreach($result as $row){

                    $ctr +=1;
                    $trRow = <<<EOD
                             <tr>
                                <td>$ctr</td>
                                <td > <span id="lnk-transnum" style="text-decoration:underline; color:blue; cursor:pointer;" data-transnum="$row->trans_no">$row->trans_no</td>
                                <td>$row->batch_no</td>
                                <td>$row->full_name</td>
                                <td>$row->gender</td>
                                <td>$row->passport</td>
                                <td>$row->arrival</td>
                                <td>$row->fov_num</td>
                                <td>$row->trans_status</td>
                            </tr>   
EOD;
                    $trList .= $trRow;
            }
            
            return $trList;
        }
    }
    
    # GETTING AGENT BASED TRANSACTION
    public function get_agenttransac($from, $to, $type, $id)
    {
        $cFrom = $this->vua_lib->isodate($from);
        $cTo   = $this->vua_lib->isodate($to);

        $all      = "WHERE vt.trans_status NOT IN('JUNKED', 'DELETED') AND bt.arrival BETWEEN ? AND ? AND created_by = ?";
        $typebase = "WHERE vt.trans_status = ? AND bt.arrival BETWEEN ? AND ? AND created_by = ?";
        
        $result = NULL;
        
        if($type == 'all'){
            $Q = $this->db->query($this->sqlbase.$all, [$cFrom, $cTo, $id]);
            $result = $Q->result();
        }else{
            $Q = $this->db->query($this->sqlbase.$typebase, [$type, $cFrom, $cTo, $id]);
            $result = $Q->result();
        }
        
        if(count($result) === 0){
            return 'No data found';
        }else{
            $trList = "";
            $ctr    = 0;
            
                foreach($result as $row){

                    $ctr +=1;
                    $trRow = <<<EOD
                             <tr>
                                <td>$ctr</td>
                                <td > <span id="lnk-transnum" style="text-decoration:underline; color:blue; cursor:pointer;" data-transnum="$row->trans_no">$row->trans_no</td>
                                <td>$row->batch_no</td>
                                <td>$row->full_name</td>
                                <td>$row->gender</td>
                                <td>$row->passport</td>
                                <td>$row->arrival</td>
                                <td>$row->fov_num</td>
                                <td>$row->trans_status</td>
                            </tr>   
EOD;
                    $trList .= $trRow;
                }
            
            return $trList;    
        }
    }

}


/* End of file Trabsactions_model.php */
/* Location: ./application/models/Trabsactions_model.php */