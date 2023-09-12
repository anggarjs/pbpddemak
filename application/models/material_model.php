<?php
class Material_model extends CI_Model
{

	function insert_kebutuhan_mdu($data)
	{
		$this->db->insert('data_kebutuhan_mdu', $data);
	} //end of function	

	function cek_id_mdu($nama_mdu)
	{
		$this->db->select('id_detail_mdu');
		$this->db->from('data_detail_mdu');
		$this->db->like('nama_detail_mdu', $nama_mdu);
		$query = $this->db->get();
		return $query;
	} //end of function	

	function hapus_kebutuhan_mdu($id_capel)
	{
		$this->db->where('id_capel', $id_capel);
		$this->db->delete('data_kebutuhan_mdu');
	} //end of function

	function get_data_material($id_capel)
	{
		$this->db->select('*');
		$this->db->from('view_kebutuhan_mdu');
		$this->db->where('id_capel', $id_capel);
		$query = $this->db->get();
		return $query;
	} //end of function

	function get_status_material()
	{
		$this->db->select('*');
		$this->db->from('data_status_material');
		$query = $this->db->get();
		return $query;
	} //end of function	

	function reset_status_material($data, $id_capel)
	{
		$this->db->where('id_capel', $id_capel);
		$this->db->update('data_kebutuhan_mdu', $data);
	} //end of function	

	function update_status_material($data, $id_rincian_mdu)
	{
		$this->db->where('id_rincian_mdu', $id_rincian_mdu);
		$this->db->update('data_kebutuhan_mdu', $data);
	} //end of function	
	public function search_material_kurang($keyword)
	{
		if (!$keyword) {
			return null;
		}
		$this->db->like('nama_detail_mdu', $keyword);
		return $this->db->get('view_material_kurang')->result();
	}
	public function detail_material_kurang($nama_detail_mdu){
		$this->db->where('nama_detail_mdu', $nama_detail_mdu);
		return $this->db->get('view_rincian_plgn_kurang_mdu')->result();
	}
}//end of class
