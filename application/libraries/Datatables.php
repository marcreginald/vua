<?php 
// this one is working (must try)
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Datatables extends CI_Model{

    private $tab_name;

    private $tab_order;

    private $col_to_search;

    private $order_by;

    function __construct(){
        parent::__construct();
        error_reporting(0); // disabled some useless error reporting
    }

    /* 
        @param tab_name(string), col_order[](indexArray), col_search[](indexArray), order_by[](indexArray)  
    */
    public function setVar($tab_name, $tab_order = [], $col_to_search = [], $order_by = []){
        $this->tab_name = $tab_name;
        $this->tab_order = $tab_order;
        $this->col_to_search = $col_to_search;
        $this->order_by = $order_by;
    }

    /* the one processing it all*/
    private function get_dataTable_q(){
        $ctr = 0; 
        $this->db->from($this->tab_name);

        /* yung mga nakalagay sa POST[key][value] chenicheck lang kung true yung laman nun*/
        foreach ($this->col_to_search as $key) {

            /*input type = [key_search][ele_value] in the POST Array*/
            if ($_POST['search']['value']) {

                /* strictly equal including the data type*/
                if ($ctr === 0) {

                    $this->db->group_start(); // grouping_start

                    $this->db->like($key, $_POST['search']['value']);
                }
                else{

                    $this->db->or_like($key, $_POST['search']['value']);
                }

                //last loop
                        // lenght - 1
                if (count($this->col_to_search) - 1 == $ctr) {

                    $this->db->group_end(); // grouping_endded
                }
            }
            $ctr = $ctr + 1; // $ctr++

            /*ordering the data*/
            if (isset($_POST['order'])) {

                /* 
                col_oder[key][value][?]= inserting

                order_by('odr', 'str_pos');
                */
                $this->db->order_by($this->tab_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

            }
            else if(isset($this->tab_order)){

                $order = $this->order_by;

                /*key() - return the key of the array*/
                $this->db->order_by(key($order), $order[key($order)]);
            }

        }//e_foreach
    }//e()

	public function get_data(){
		/* execute the dtable query */
		$this->get_dataTable_q();
		if ($_POST['length'] != -1) {				
            // dropbox lenght, 1
			$this->db->limit($_POST['length'], $_POST['start']);
			$Q = $this->db->get();
			return $Q->result();
		}
	}

	public function filtered_data(){
		$this->get_dataTable_q();
		$Q = $this->db->get();
		return $Q->num_rows();
	}

	public function count_data(){
		$this->db->from($this->tab_name);
		return $this->db->count_all_results();
	}

	public function get_id_data($uid, $where){
        //$this->db->from(); //from
		$this->db->where($where, $uid); //where
		$Q = $this->db->get($this->tab_name);// select *
		return $Q->row(); // returbn the specific row
	}

	public function save_data($data = []){
		$this->db->insert($this->tab_name, $data);
		return $this->db->insert_id();
	}

	public function update_row_data($where, $data){
		$this->db->update($this->tab_name, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_row_data($uid, $where){
		$this->db->where($where, $uid);
		$Q = $this->db->delete($this->tab_name);

		if ($Q) {
			
			return TRUE;
		}
		else{

			return FALSE;
		}
	}
        
}//e_class


/* 
this datatable class is created by 
	JOHN LITO BARDINAS
	12/1/2016
    
    Production Testing:
    2:57PM 12-26-2017
*/