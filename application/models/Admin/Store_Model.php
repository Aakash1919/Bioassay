<?php

class Store_Model extends Admin_Model{

	protected $_table_name = "category";

	public function __construct(){
		parent::__construct();
	}
	public function Getbyid($id)
	{
		$this->db->where('category_id',$id);
		$this->db->select()->from($this->_table_name);
		return $this->db->get()->result();
	}
	public function GetAllParentCategories()
	{
		$this->db->select()->from($this->_table_name);
		return $this->db->get()->result();
	}
}