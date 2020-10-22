<?php

class Admin_User extends Admin_Model{

	protected $_table_name = 'bioassy_admin';

	public function updatepassword($id,$password){

		$this->db->where('id',$id);
		$this->db->select()->from($this->_table_name);
		$row = $this->db->get()->num_rows();
		if($row==1){
			$data = array(
				'Password'=>base64_encode($password)
			);
			$this->db->where('id',$id);
			$this->db->update($this->_table_name,$data);
			return true;
		}else{
			return false;
		}
	}
}