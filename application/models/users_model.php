<?php
class Users_model extends CI_Model
{

	//get data login
	function get_all_untuk_login()
	{
		$this->db->select('*');
		$this->db->from('data_user');
		$query = $this->db->get();
		return $query;
	} //end of function	

	function get_data_ulp(){
		$this->db->select('*');
		$this->db->from('data_ulp');
		$query = $this->db->get();
		return $query;
	} //end of function

	function get_data_role()
	{
		$this->db->select('*');
		$this->db->from('data_role');
		$query = $this->db->get();
		return $query;
	} //end of function

	function cek_login($user_id, $pswd)
	{
		$this->db->select('*');
		$this->db->from('view_user');
		$this->db->where('nama_user', $user_id);
		$this->db->where('pass_user', $pswd);
		$query = $this->db->get();
		return $query;
	} //end of function	

	function insert_user($data)
	{
		$this->db->insert('data_user', $data);
	} //end of function	

	//get data login
	function get_all_data_user()
	{
		$this->db->select('*');
		$this->db->from('view_user');
		$query = $this->db->get();
		return $query;
	} //end of function	

	// get data capel
	function get_all_data_capel()
	{
		$this->db->select('*');
		$this->db->from('view_capel');
		$query = $this->db->get();
		return $query;
	} //end of function	

	function update_user($data, $id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->update('data_user', $data);
	} //end of function	

	public function pilih_data_user($id_user)
	{
		$this->db->select("*");
		$this->db->from("view_user");
		$this->db->where("id_user", $id_user);
		$query = $this->db->get();
		return $query;
	}
	function hapus_data_user($id_user){
		$this->db->where('id_user', $id_user);
		return $this->db->delete('data_user');
	}
	// end of function
}//end of class
