<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Junk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->model('visatransaction_model', 'vt');
        $this->load->model('batchedvt_model', 'bt');
        $this->load->model('twobatchvt_model', 'tbt');
	}

	public function index()
	{
		if(!check_session()){
			redirect('login');
		}
		else
		{
	        $data['title'] = "Junk (破爛)";
			$data['header'] = <<<EOD
				<h1 class="page-header"> Junk (破爛)<small> This are the deleted transactions </small></h1><hr>
EOD;

			$data['user_dat'] = array(
					'name'   => get_cookie('fullname'),
					'pic'    => base_url(get_cookie('profile_pic')),
					'noti'   => 1, // change these to 0
					'userid' => get_cookie('user_id')
			);

	        $data['acc_type'] = get_cookie('user_type');
	        setcookie('active', '#junk', time() + (86400 * 30), "/");
	        
			$this->load->view('pages/junk_v', $data);
		}
        
        /* organize the view for the junk */
	}
    
    /* just selecting all visa transaction that the status is junked*/
    public function dtjunk()
    {
        $res = $this->vt->junked_view();
        print $res;
    }
    
    /* discarding all the junked file (all)*/
    public function discardalljunk()
    {
        $q = $this->tbt->discardall_junked();
        return_json((boolean)$q, TRUE);
    }
    
    /* discarding the selected junk transaction (selected)*/
    public function discardselected()
    {
        
        $selectedArr = $_POST['selectedjunk'];
        $ln          = count($selectedArr);
        $isDone      = TRUE;
        
        if($ln < 1){
            retrun_json(FALSE,TRUE);
        }else{
            
            for($i=0; $i<$ln; $i++){
                $isDone &= $this->tbt->discardselected_junked($selectedArr[$i]);   
            }
            
            return_json($isDone, TRUE);
            
        }
    }
}
