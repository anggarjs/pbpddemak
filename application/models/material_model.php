<?php
class Material_model extends CI_Model
{

	function insert_kebutuhan_mdu($data){
		$this->db->insert('data_kebutuhan_mdu', $data);
	} //end of function	
	
	function insert_kebutuhan_tibet($data){
		$this->db->insert('data_kebutuhan_tibet', $data);
	} //end of function		

	function cek_id_mdu($nama_mdu){
		$this->db->select('id_detail_mdu');
		$this->db->from('data_detail_mdu');
		$this->db->like('nama_detail_mdu', $nama_mdu);
		$query = $this->db->get();
		return $query;
	} //end of function	

	function hapus_kebutuhan_mdu($id_capel){
		$this->db->where('id_capel', $id_capel);
		$this->db->delete('data_kebutuhan_mdu');
	} //end of function
	
	function hapus_kebutuhan_tibet($id_capel){
		$this->db->where('id_capel', $id_capel);
		$this->db->delete('data_kebutuhan_tibet');
	} //end of function	

	function get_data_material($id_capel){
		$this->db->select('*');
		$this->db->from('view_kebutuhan_mdu');
		$this->db->where('id_capel', $id_capel);
		$query = $this->db->get();
		return $query;
	} //end of function
	
	function get_data_tibet($id_capel){
		$this->db->select('*');
		$this->db->from('view_kebutuhan_tibet');
		$this->db->where('id_capel', $id_capel);
		$query = $this->db->get();
		return $query;
	} //end of function	

	function get_status_material(){
		$this->db->select('*');
		$this->db->from('data_status_material');
		$query = $this->db->get();
		return $query;
	} //end of function	

	function reset_status_material($data, $id_capel){
		$this->db->where('id_capel', $id_capel);
		$this->db->update('data_kebutuhan_mdu', $data);
	} //end of function	

	function update_status_material($data, $id_rincian_mdu){
		$this->db->where('id_rincian_mdu', $id_rincian_mdu);
		$this->db->update('data_kebutuhan_mdu', $data);
	} //end of function	
	
	public function search_material_kurang($keyword){
		if (!$keyword) {
			return null;
		}
		$this->db->like('nama_detail_mdu', $keyword);
		return $this->db->get('view_material_kurang')->result();
	}
	
	function detail_material_kurang($id_detail_mdu){
		$this->db->where('id_detail_mdu', $id_detail_mdu);
		return $this->db->get('view_rincian_plgn_kurang_mdu')->result();
	}
	
	function detail_material_lengkap($id_detail_mdu){
		$this->db->where('id_detail_mdu', $id_detail_mdu);
		return $this->db->get('view_rincian_plgn_lengkap_mdu')->result();
	}

	function detail_tibet_kurang($id_detail_mdu){
		$this->db->where('id_detail_mdu', $id_detail_mdu);
		return $this->db->get('view_kebutuhan_tibet')->result();
	}	
	
	function get_material_kurang(){
		$this->db->select("*");
		$this->db->from('view_material_kurang');
		$query = $this->db->get();			
		return $query;
	}//end of function
	
	function get_material_kurang_per_plgn(){
		$this->db->select("*");
		$this->db->from('view_material_kurang_per_pelanggan');
		$query = $this->db->get();			
		return $query;
	}//end of function	
	
	function get_tibet_kurang(){
		$this->db->select("*");
		$this->db->from('view_rekap_keb_tibet');
		$query = $this->db->get();			
		return $query;
	}//end of function	
	
	function get_material_lengkap(){
		$this->db->select("*");
		$this->db->from('view_material_lengkap');
		$query = $this->db->get();			
		return $query;
	}//end of function
	
	function get_tipe_trafo(){	
		$this->db->select("*");
		$this->db->from('data_detail_mdu');
		$this->db->where('id_master_mdu',15);
		$query = $this->db->get();			
		return $query;	
	}//end of function
	
	function get_merk_trafo(){	
		$this->db->select("*");
		$this->db->from('data_merk_material');
		$query = $this->db->get();			
		return $query;	
	}//end of function
	
	function insert_material_rusak($data){	
		$this->db->insert('data_material_rusak', $data);
	}//end of function
	
	function cek_material_rusak($no_pole_material_rusak,$id_detail_mdu){		
		$this->db->select('id_material_rusak');
		$this->db->from('data_material_rusak');		
		$this->db->like('no_pole_material_rusak',$no_pole_material_rusak);
		$this->db->where('id_detail_mdu',$id_detail_mdu);
		$query = $this->db->get();
		return $query;		
	}//end of function
	
	function get_data_material_rusak($id_material_rusak){		
		$this->db->select('*');
		$this->db->from('view_material_rusak');		
		$this->db->where('id_material_rusak',$id_material_rusak);
		$query = $this->db->get();
		return $query;		
	}//end of function
	
	function get_all_material_rusak(){
		$this->db->select("*");
		$this->db->from('view_material_rusak');	
		$this->db->order_by('tgl_material_rusak', 'ASC');	
		$query = $this->db->get();			
		return $query;
	}//end of function
	
	function get_all_material_rusak_ulp($ulp){
		$this->db->select("*");
		$this->db->from('view_material_rusak');
		$this->db->where('id_ulp',$ulp);
		$this->db->order_by('tgl_material_rusak', 'ASC');			
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_status_material_rusak(){
		$this->db->select('*');
		$this->db->from('data_status_material_rusak');
		$query = $this->db->get();
		return $query;
	} //end of function
	
	function update_material_rusak($data, $id_material_rusak){	
		$this->db->where('id_material_rusak', $id_material_rusak);
		$this->db->update('data_material_rusak', $data);
	}//end of function	
	
	function rollback_material($data, $id_capel){	
		$this->db->where('id_capel', $id_capel);
		$this->db->update('data_kebutuhan_mdu', $data);
	}//end of function
	
}//end of class
