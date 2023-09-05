<?php
class Material_model extends CI_Model {
	
	function insert_kebutuhan_mdu($data){	
		$this->db->insert('data_kebutuhan_mdu', $data);
	}//end of function	
	
	function cek_id_mdu($nama_mdu){		
		$this->db->select('id_detail_mdu');
		$this->db->from('data_detail_mdu');		
		$this->db->like('nama_detail_mdu',$nama_mdu);
		$query = $this->db->get();
		return $query;		
	}//end of function	
	
	function hapus_kebutuhan_mdu($id_capel){	
		$this->db->where('id_capel',$id_capel);
		$this->db->delete('data_kebutuhan_mdu');	
	}//end of function	
}//end of class
?>