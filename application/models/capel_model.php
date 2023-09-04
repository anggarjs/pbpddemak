<?php
class Capel_model extends CI_Model {
	
	function insert_capel($data){	
		$this->db->insert('data_capel', $data);
	}//end of function	
	
	function cek_capel($nama_plgn,$daya){		
		$this->db->select('id_capel');
		$this->db->from('data_capel');		
		$this->db->like('nama_capel',$nama_plgn);
		$this->db->where('daya_baru',$daya);
		$query = $this->db->get();
		return $query;		
	}//end of function	
	
}//end of class
?>