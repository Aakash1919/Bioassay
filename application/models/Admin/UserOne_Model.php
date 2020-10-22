<?php
class UserOne_Model extends CI_Model{

	protected $_table_name = "bioassy_admin";

	public function __construct(){
		parent::__construct();
	}
	public function login($username,$password)
	{

		$this->db->where('Username',$username);
		$this->db->where('Password',$password);
		$this->db->select()->from($this->_table_name);
		$rows=$this->db->get()->num_rows();
		if($rows>0)
		{
			$this->db->where('Username',$username);
			$this->db->where('Password',$password);
			$this->db->select()->from($this->_table_name);
			$admin_id=$this->db->get()->row()->id;
			$userSession = array(
									'id' =>$admin_id,
									'user_type'=>'admin',
							        'logged_in' => TRUE
							);
				$this->session->set_userdata($userSession);
			return true;
		}else
		{
			return false;
		} 
	}

	public function log1($u,$p){
		$this->db->select()->from($this->_table_name);
		return $this->db->get()->result();
	}
}