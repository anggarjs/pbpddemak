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
	
	function hapus_capel($id_capel){	
		$this->db->where('id_capel',$id_capel);
		$this->db->delete('data_capel');	
	}//end of function
	
	function get_all_data_capel(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_capel <','4');		
		$this->db->order_by('tgl_persetujuan', 'ASC');	
		$query = $this->db->get();			
		return $query;
	}//end of function
	
	function get_all_data_capel_ulp($ulp){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_ulp',$ulp);
		$this->db->where('id_status_capel <','4');		
		$this->db->order_by('tgl_persetujuan', 'ASC');			
		$query = $this->db->get();
		return $query;
	}//end of function	
	
	function get_all_data_capel_approved(){
		$this->db->select("*");
		$this->db->from('view_capel');
		/* $this->db->where('id_status_material <','3'); */
		$this->db->order_by('id_status_material', 'ASC');
		$this->db->order_by('tgl_persetujuan', 'ASC');
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_all_data_capel_lgkp_material(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_material >','2');
		$this->db->where('id_status_capel <','3');
		$query = $this->db->get();
		return $query;
	}//end of function	
	
	
	function get_all_data_capel_lgkp_material_ulp($ulp){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_material >','2');
		$this->db->where('id_status_capel <','3');		
		$this->db->where('id_ulp',$ulp);
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_all_data_capel_sudah_bayar(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_capel <','3');
		$query = $this->db->get();
		return $query;
	}//end of function	
	
	function get_all_data_capel_sudah_bayar_ulp($ulp){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_capel','3');		
		$this->db->where('id_ulp',$ulp);
		$query = $this->db->get();
		return $query;
	}//end of function		
	
	function get_data_capel($id_capel){		
		$this->db->select('*');
		$this->db->from('view_capel');		
		$this->db->where('id_capel',$id_capel);
		$query = $this->db->get();
		return $query;		
	}//end of function

	function get_status_capel(){
		$this->db->select('*');
		$this->db->from('data_status_capel');
		$query = $this->db->get();
		return $query;
	} //end of function

	function update_capel($data, $id_capel){	
		$this->db->where('id_capel', $id_capel);
		$this->db->update('data_capel', $data);
	}//end of function
	
	function update_kondisi_material($data, $id_capel){	
		$this->db->where('id_capel', $id_capel);
		$this->db->update('data_capel', $data);
	}//end of function

		
}//end of class
?>