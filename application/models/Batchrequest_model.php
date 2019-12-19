<?php if ( ! defined('BASEPATH')) exit('No direct script allowed');

/*
    Visa Batched Request model interaction
*/
class Batchrequest_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('array');
    }

    /* use by the admin/manager type (good)*/
    public function get_allbatchrequest()
    {
        $q = $this->db->get(BATCH_RQL);
        $res = $q->result();
        
        return $this->parseto_html($res);
    }
    
    /*
        2. THE READING OF THE VISA TRANSACTION
           => JUST TAGGING THE BATCHREQUEST_LOG TO BE READ. NOT NEW 
    */
    public function tagas_read($batchrqlId)
    {
        $this->db->where('id', $batchrqlId);
        $readStat = 'read';
        $q = $this->db->update(BATCH_RQLLOGS, array('batchrequest_stat' => $readStat));        
        return (boolean)$q;
    }
    
    /*
        4. IN THE AGENT GETTING ALL THE APPROVE BATCH_STATUS IN THE PAST 7 DAYS
           AND ALSO USING THE AGENT ID TO FILTER ONLY ITS. SENDED BATCH NO OTHER THAT HIS/HER ONLY
    */
    public function agentbase_batchrql($agentId)
    {
        /* dapat ahh kinuko kadi so mga batch transaction na na approve na status na where so ID amo dapat adi ID kadi Agent na sadi ehh parameter alright!!!*/
        /*$SQL = "CALL agentRightBar(?)";
        $q = $this->db->query($SQL, [$agentId]);*/
        $q = $this->db->get_where(BATCH_RQL, array('sender_id' => $agentId, 'batch_status' => 'approved'));
        $res =  $q->result();
        
        return $this->parseto_html($res);
    }
    
    
    
    
/* PRIVATE METHODS HERE (weird php :D )*/
    public function parseto_html($res)
    {
        
        $ul = '<ul class="notification-list">';
        $li = '';
        
        if(count($res) != 0){
            
            foreach($res as $noti){
                $batchStat = '';
                $batchNum  = strtoupper($noti->batch_no);
                $dateSent  = $noti->date_sent;
                $senderName= $noti->sender;
                $profilePath = $noti->profile_pic;

                if($noti->status == 'NEW'){
                    $batchStat = '<span class="badge badge-success m-b-5">New</span>'; 
                }else{
                    if($noti->batch_status == 'approved'){
                        $batchStat = '<span class="badge badge-success m-b-5">Approved</span>'; 
                    }else{
                        $batchStat = '<span class="badge badge-danger m-b-5">Read</span>';
                    }
                }

                $img = base_url($profilePath);
                $li = <<<EOT
                      <li>
                        <div class="media"><div class="media"><img src="$img" alt="$senderName" /></div></div>
                        <div class="info">
                            <div class="title"> <a href="javascript:;">$batchNum</a> </div>
                            <div class="time">$dateSent</div>
                            <div class="desc">$senderName</div>

                            $batchStat
                        </div>
                    </li>   
EOT;

                $ul .= $li;

                // 5:15 PM 2/28/2018
                // unfinised must finish at home.
            }
            
        }else{
            
            $li .= '<li style="color: white;"> No. Notification!! </li>';
            
            $ul .= $li;
            
        }
        

        return $ul .= "</ul>";
    }
    
}