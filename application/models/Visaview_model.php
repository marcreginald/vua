<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Visaview_model
class Visaview_model extends CI_Model {
    
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
	}

    /* UPDATING THE STAMPPED PIC IN A PARTICULAR vt.id */
    public function update_vtstamppedpass($id, $filename)
    {
        
        $picpath = 'uploads/'.$filename;
        $this->db->where('id', $id);
        $Q = $this->db->update(VISA_TRANSAC, array('stampped_passport' => $picpath));
        
        if($Q){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function approve_inprocessrql($batchNo, $rqlId, $dateApprove, $filePaths, $managerId)
    {
        
        $approved_Dat = array(
            'rql_id'                            => $rqlId,
            'date_approved'                     => $dateApprove, 
            'filepath_approved_confirmationrql' => $filePaths, // must be converted to ISO date format
            'approved_id'                       => $managerId
        );
        
        $q = $this->db->insert(APPROVE_RQL, $approved_Dat);
        
        $this->db->where('requestletter_id', $rqlId);
        $q1 = $this->db->update(REQS_LTR, array('rq_status' => 'approved'));
        
        $this->db->where('batch_no', $batchNo);
        $q2 = $this->db->update(BATCH_VT, array('batch_status' => 'approved', 'manager_id' => $managerId));
        
        $this->db->where('batch_no', $batchNo);
        $q3 = $this->db->update(VISA_TRANSAC, array('trans_status' => 'APPROVED'));
        
        return ((boolean)$q && (boolean)$q1 && (boolean)$q2 && (boolean)$q3);
    }

    /* getting the approved (batch, rql, visatransac) */
    /* the date is an ISO DATE FORMAT FOR DB */
    public function get_tblapproved($from, $to)
    {
        
        $SQL = "SELECT * FROM approved_view WHERE iso_date BETWEEN ? AND ?";
        $q = $this->db->query($SQL, [$from, $to]);
        $result = $q->result();

        foreach($result as &$row){
            $row->total_records = $this->get_totalrec($row->batch_no);
        }

        if(count($result) === 0){
            return '<tr> No Data Found. </tr>';
        }else{
            
            $trList = "";
            
            foreach($result as &$row){
                
                $reqNum     = $row->rql_id;
                $batchNum   = $row->batch_no;
                $upbatchNum = strtoupper($batchNum);
                
                $trRow = <<<EOD
                    <tr>
                        <td>$reqNum</td>
                        <td> <span class="lk-edit" data-crntrqlid="$reqNum">$upbatchNum</span></td>
                        <td>$row->total_records</td>
                        <td>$row->letter_date</td>
                        <td>$row->arrival</td>
                        <td>$row->fov</td>
                        <td>$row->created_by</td>
                        <td>$row->date_generated</td>
                    </tr>   
EOD;
                
                $trList .= $trRow;
                
                /*
                    <td><a class="btn btn-success btn-icon btn-sm" id="btn-printdraft-rql" data-crntrql="$reqNum"><i class="fa fa-print"></i></a></td>
                */
            }
            
            return $trList;
            
        }
        
    }
    
    /* GETTING THE APPROVED INFO VIA request_id */
    public function approved_rqlinfo($rqlId)
    {
        
        $q = $this->db->get_where(APPROVE_RQL, array('rql_id' => $rqlId));
        return $q->first_row();
    }
    
/* PRIVATE METHODS */
    /* count the total visa transaction in one batch*/
    private function get_totalrec($batchNum)
    {
        $this->db->where_not_in('trans_status', array('JUNKED', 'PENDING'));
        $batchTotal = $this->db->get_where(VISA_TRANSAC, array('batch_no' => $batchNum));
        return $batchTotal->num_rows(); // return an intergers of the result 
    }
}


/* End of file Visaview_model.php */
/* Location: ./application/models/Visaview_model.php */