<?php
class Google_model extends CI_Model
{

	//get data login
	function get_data_oauth_google()
	{
		$this->db->select('*');
		$this->db->from('data_oauth_google');
		$query = $this->db->get();
		return $query;
	} //end of function	


}//end of class
