<?php
class Capel_model extends CI_Model {
	
	function insert_capel($data){	
		$this->db->insert('data_capel', $data);
	}//end of function	
	
	function get_data_ulp(){
		$this->db->select('*');
		$this->db->from('data_ulp');
		$this->db->where('id_ulp >','52550');		
		$query = $this->db->get();
		return $query;
	} //end of function	
	
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
		$this->db->where('id_status_capel >','1');	
		$this->db->order_by('tgl_persetujuan', 'ASC');	
		$query = $this->db->get();			
		return $query;
	}//end of function
	
	function get_all_data_capel_ulp($ulp){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_ulp',$ulp);
		$this->db->where('id_status_capel <','4');
		$this->db->where('id_status_capel >','1');
		$this->db->order_by('tgl_persetujuan', 'ASC');			
		$query = $this->db->get();
		return $query;
	}//end of function	
	
	function get_all_data_capel_approved(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_capel >','1');
		$this->db->where('id_status_material <','3');
		$this->db->order_by('id_status_material', 'ASC');
		$this->db->order_by('tgl_persetujuan', 'ASC');
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_all_data_capel_lengkap(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_material >','2');
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

	function get_all_capel_awal(){
		$this->db->select('*');
		$this->db->from('view_capel');
		$this->db->where('id_status_capel <','3');			
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


	function get_all_capel(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_total($var){
		$this->db->select($var);
		$this->db->from('view_capel');
		$query = $this->db->get();
		return $query;
	}//end of function

	function get_total_cpl_status_material($var){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_material', $var);		
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_total_status_lengkap(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_material >2');		
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_total_cpl_status_plgn($var){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_capel', $var);		
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_all_status_capel($var){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->like('status_capel',$var);	
		$query = $this->db->get();
		return $query;
	}//end of function
	
	function get_status_capel_non_peremajaan(){
		$this->db->select('*');
		$this->db->from('data_status_capel');
		$this->db->where('id_status_capel <','4');
		$query = $this->db->get();
		return $query;
	} //end of function	
	
	function get_status_capel_by_status_capel_dan_ulp($status_capel,$ulp){
		$this->db->select('sum(daya_lama) as total_daya_lama,sum(daya_baru) as total_daya_baru');
		$this->db->from('view_capel');
		$this->db->like('status_capel',$status_capel);
		$this->db->like('id_ulp',$ulp);	
		$query = $this->db->get();
		return $query;
	} //end of function	
	
	function get_data_capel_bermohon($nama_capel,$ulp){
		$this->db->select('srt_nama_capel,srt_alamat_capel,srt_daya_awal_capel,nama_ulp');
		$this->db->from('view_capel');
		$this->db->like('srt_nama_capel',$nama_capel);
		$this->db->like('id_ulp',$ulp);	
		$query = $this->db->get();
		return $query;
	} //end of function		
	
	function cek_capel_bermohon($nama_plgn,$daya){		
		$this->db->select('id_capel');
		$this->db->from('data_capel');		
		$this->db->like('srt_nama_capel',$nama_plgn);
		$this->db->where('srt_daya_awal_capel',$daya);
		$query = $this->db->get();
		return $query;		
	}//end of function
	
	function get_all_data_capel_bermohon(){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_status_capel <','1');		
		$this->db->order_by('tgl_persetujuan', 'ASC');	
		$query = $this->db->get();			
		return $query;
	}//end of function
	
	function get_all_data_capel_bermohon_ulp($ulp){
		$this->db->select("*");
		$this->db->from('view_capel');
		$this->db->where('id_ulp',$ulp);
		$this->db->where('id_status_capel <','1');		
		$this->db->order_by('tgl_persetujuan', 'ASC');			
		$query = $this->db->get();
		return $query;
	}//end of function		
	
}//end of class
?>