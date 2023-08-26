<?php
class Users_model extends CI_Model {

	//get data login
	function get_all_untuk_login(){		
		$this->db->select('*');
		$this->db->from('data_user');
		$query = $this->db->get();		
		return $query;						
	}//end of function	
	
	function get_data_ulp(){		
		$this->db->select('*');
		$this->db->from('data_ulp');
		$query = $this->db->get();		
		return $query;		
	}//end of function
		
	function get_data_role(){		
		$this->db->select('*');
		$this->db->from('data_role');
		$query = $this->db->get();		
		return $query;		
	}//end of function
	
	function cek_login($user_id,$pswd){		
		$this->db->select('*');
		$this->db->from('data_user');		
		$this->db->where('nama_user',$user_id);
		$this->db->where('pass_user',$pswd);
		$query = $this->db->get();
		return $query;		
	}//end of function	

	function insert_user($data){	
		$this->db->insert('data_user', $data);
	}//end of function	
	
	//get data login
	function get_all_data_user(){		
		$this->db->select('*');
		$this->db->from('view_user');
		$query = $this->db->get();		
		return $query;						
	}//end of function	
	
	function get_info_login($user_id){		
		$this->db->select('dc_pegawai.PEGAWAI_NAMA,dc_user_aplikasi.USER_NAMA,dc_pegawai.BAGIAN_APJ_ID');
		$this->db->from('dc_user_aplikasi');
		$this->db->join('dc_pegawai', 'dc_user_aplikasi.PEGAWAI_ID = dc_pegawai.PEGAWAI_ID');		
		$this->db->where('USER_ID',$user_id);
		$query = $this->db->get();
		return $query;		
	}//end of function	

	
	function get_upj_id($user_id){		
		$this->db->select('UPJ_ID');
		$this->db->from('dc_pegawai');
		$this->db->where('PEGAWAI_ID',$user_id);
		$query = $this->db->get();
		return $query;		
	}//end of function	
	
	function get_data_user($id){
		$table_name = "pbk";
		
		$this->db->select("*",FALSE);
		$this->db->from($table_name);
		
		$this->db->where('IdPbk', $id);		
		$return		= $this->db->get();
		return $return;
	}//end of function			
	
	function get_all_users(){
		$table_name = "pbk";
		
		$this->db->select("*");
		$this->db->from($table_name);
		$this->CI->flexigrid->build_query();
		$return['records'] = $this->db->get();
		
		$this->db->select("*");
		$this->db->from($table_name);	
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();

		return $return;
	}//end of function	
	
	function insert_user_sms($data){	
		$this->db->insert('pbk', $data);
	}//end of function
	
	function insert_log_activity($data){	
		$this->db->insert('dc_log_activity', $data);
	}//end of function	
	
	function update_user_sms($data,$id){	
		$this->db->where('IdPbk', $id);	
		$this->db->update('pbk', $data);	
	}//end of function	
	
	public function hapus_user($id_user){
		$this->db->where('IdPbk',$id_user);
		$this->db->delete('pbk');
	}//end of function		
	
	function update_password($data, $user_id){	
		$this->db->where('USER_ID', $user_id);
		$this->db->update('dc_user_aplikasi', $data);
	}//end of function	
}//end of class
?>