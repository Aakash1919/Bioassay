<?php

class Services_Model extends Admin_Model{

	protected $_table_name = "bioassy_services";

	public function __construct(){
		parent::__construct();
	}
	public function GetProperty($title,$id)
	{
		$this->db->where('id',$id);
		$this->db->select()->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows>0){
			$this->db->where('id',$id);
			$this->db->select()->from($this->_table_name);
			return $this->db->get()->row()->$title;
		}else{
			return false;
		}
		
	}
}