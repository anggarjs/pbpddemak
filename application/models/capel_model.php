<?php
class Capel_model extends CI_Model {
	
	function insert_capel($data){	
		$this->db->insert('data_capel', $data);
	}//end of function	
	

}//end of class
?>