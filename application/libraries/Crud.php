<!--
    CRUD library properties
    
    1. tbl_name
    2. coloum name
    3. primary key

   # THE CLASS MUST ONLY BE USED TO DELETE ATOMIC RECORD FROM THE (n) TABLE
   
    PSEUDO
        *. pick s specific table to work with
        *. perform a basic insert to that table
        *. just focus just in the CRUD functionality of every TABLE

INSERT RECORD
SELECT ALL THE FIELDS OF THE TABLE 
UPDATE A RECORD
DELETE A RECORD

    NEXT TIME MY CRUD IS ONLY IN THE ONE MODEL :d SAVAEGGGGE
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); // protection
/*
    LEGEND:
        (n) => just a table
        [x] => just a table column
*/
class Crud 
{
    // ci super ultra object
	protected $ci;
    
    // the table to work
    protected $tbl;
    
    // indexed array to work with the insert or update
    protected $columns = array();
    
    // table col name
    public $tblcol = array();

	public function __construct($dbName)
	{
		// get the refference for the CI object super ulta object
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->tbl = $dbName['tbl']; // set the table name to work with
	}
    
    /* use the helper('array') to create the data parameter */
    /*
        $tbl (string) => tbl name
        $data (assoc) => key => value for the table 
    */
    public function insert($data){
        if(is_array($col) && is_array($data)){ // if the col and data is an array proceed
            $q = $this->db->insert($this->tbl, $data);
            return (boolean)$q; // typecast the $q var to a FALSE E or TRUE E value
        }else{
            return FALSE;
        }
    }
    
    /* get a specific information of the (n)[x] name */
    public function getinfo($id, $needle){
        $where = array(
            $id => $needle 
        );
        $q = $this->db->get_where($this->tbl, $where);
    }
}

/* End of file Johnlito.php */
/* Location: ./application/libraries/Johnlito.php */

/* NOT YET IN PRODUCTION MODE NEED TOBE IMPROVED */
