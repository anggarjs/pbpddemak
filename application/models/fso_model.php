<?php
class Fso_model extends CI_Model{

	function insert_to_temporary($data){
		$this->db->insert('fso_data_anomali_penyambungan_temp', $data);
	} //end of function	
	
	function update_to_temporary($data, $idpel)
	{
		$this->db->where('idpel', $idpel);
		$this->db->update('fso_data_anomali_penyambungan_temp', $data);
	} //end of function		
	
	function get_anomali_lat(){
		$this->db->select('lat, count(lat) as jumlah_data');
		$this->db->from('fso_data_anomali_penyambungan_temp');
		$this->db->group_by("lat");
		$this->db->having('count(lat) > 2');
		$this->db->order_by('count(lat)', 'DESC');
		
		$query = $this->db->get();
		return $query;
	} //end of function

	function detail_plgn_by_lat($lat){
		$this->db->select('id_ulp,idpelanggan,nama_plgn,tarif,daya,alamat_plgn,nama_petugas,lat,longt');
		$this->db->from('fso_data_anomali_penyambungan_temp');
		$this->db->where('lat', $lat);
		
		$query = $this->db->get();
		return $query;
	} //end of function
	
	function get_anomali_longt(){
		$this->db->select('longt, count(longt) as jumlah_data');
		$this->db->from('fso_data_anomali_penyambungan_temp');
		$this->db->group_by("longt");
		$this->db->having('count(longt) > 2');
		$this->db->order_by('count(longt)', 'DESC');
		
		$query = $this->db->get();
		return $query;
	} //end of function

	function detail_plgn_by_longt($longt){
		$this->db->select('id_ulp,idpelanggan,nama_plgn,tarif,daya,alamat_plgn,nama_petugas,lat,longt');
		$this->db->from('fso_data_anomali_penyambungan_temp');
		$this->db->where('longt', $longt);
		
		$query = $this->db->get();
		return $query;
	} //end of function			
	
	
}//end of class
