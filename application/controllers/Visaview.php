<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* for viewing the inprocess or process request letter */
class Visaview extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('twobatchvt_model', 'tbt');
        $this->load->model('visaview_model', 'vv');
        $this->load->model('requestletter_model', 'rq');
        $this->load->library('my_uploader', '', 'uploader');
	}

	public function index($rqlId)
	{
        if(!check_session()){
			redirect('login');
		}
		else
		{
            if(!$this->rq->is_rqlexist($rqlId)){
                die('false');
            }else{
                
                $data['title'] = "Visaview";
                $q =$this->rq->getrql_info($rqlId);
                $data['rql_status'] = $q->rq_status;

                if($q->rq_status == 'printed'){ // INPROCESS
                    $data['header'] = <<<EOD
                        <h1 class="page-header"> In-Process (在進程)<small> waiting for Bureau of Immigration Approval</small></h1><hr>
EOD;
                }else{ // PROCESSED
                    $data['header'] = <<<EOD
                        <h1 class="page-header">Approved Visa (批准的簽證)<small> </small></h1><hr>
                        
EOD;
                    $data['approved_info'] = $this->vv->approved_rqlinfo($rqlId);
                    $data['approved_date'] = $this->vua_lib->to_datetimepicker($data['approved_info']->date_approved);
                    $imageFiles = $data['approved_info']->filepath_approved_confirmationrql;
                    $data['image_confirmation'] = explode('/', $imageFiles);
                }

                $data['user_dat'] = array(
                        'name'   => get_cookie('fullname'),
                        'pic'    => base_url(get_cookie('profile_pic')),
                        'noti'   => 1, // change these to 0
                        'userid' => get_cookie('user_id')
                );

                $data['acc_type'] = get_cookie('user_type');
                setcookie('active', '#visa', time() + (86400 * 30), "/");
        
                // the image 
                $data['to_agent']   = $this->rq->get_batchsender($rqlId);
                $batchNum           = $this->rq->lookup_rql(array('requestletter_id' => $rqlId), 'batch_no');
                $batchInfo          = $this->bt->get_batchinfo($batchNum);
                $data['arrival']    = $this->vua_lib->to_datetimepicker($batchInfo->arrival);
                $data['batch_info'] = $batchInfo;
                $data['rql_applicants'] = $this->rq->rql_applicants($batchNum);
                $data['rql_id']         = $rqlId;
                $data['batch_num']  = $batchInfo->batch_no;
                
                $data['eticket']   = $batchInfo->attached_eticket; // di ko naya ibubutang haha
                $data['pdf_print'] = $this->rq->get_rqservicetype($rqlId); 
                // checking if the request letter is exist then supply the necessary path to be printid 
                
                // die_r($data);
                $this->load->view('pages/visaview', $data);
                
            }
	        
		}
	}
    
    /* saving the individual processed image in each visa transaction */
    public function savestampped()
    {
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $attachedStamppedpic = str_replace(' ', '_', strtolower($_FILES['stamppedpic']['name']));
            $id = $_POST['vt_id'];
            
            // database update the path in the database to the upcoming append the uploads part
            // upload the into the server
            if($this->vv->update_vtstamppedpass($id, $attachedStamppedpic)){
                
                $upload = $this->uploader->ddo_upload('stamppedpic');
                
                return_json($upload, TRUE);
            }
        }
    }
    
    /* approving the in process request letter adding the confirmation letter with it*/
    public function approvedinprocessrql()
    {

        if(isset($_FILES['confirmation_pic'])){

            $filePath = '';
            foreach($_FILES['confirmation_pic']['tmp_name'] as $key => $tmp_name)
            {
                $file_name = $key.$_FILES['confirmation_pic']['name'][$key];
                $file_size = $_FILES['confirmation_pic']['size'][$key];
                $file_tmp  = $_FILES['confirmation_pic']['tmp_name'][$key];
                $file_type = $_FILES['confirmation_pic']['type'][$key];
                
                $newName   = str_replace(array('', ' '), '_', strtolower($file_name));
                $filePath  .= time().$newName.'/';
                $uploading = move_uploaded_file($file_tmp,"uploads/".time().$newName);
            }
            
            $isoDate = $this->vua_lib->isodate($_POST['date_approved']);
            $managerId = get_cookie('user_id'); // manager user_id
            $qDb = $this->vv->approve_inprocessrql($_POST['batch_no'], $_POST['rql_id'], $isoDate, rtrim($filePath, '/'), $managerId);
            
            return_json($qDb, TRUE);
        }else{
            
            return_json(FALSE, TRUE);
        }   
    }

}

/* End of file Notfound.php */
/* Location: ./application/controllers/Notfound.php */
