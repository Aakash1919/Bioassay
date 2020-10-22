<?php
/**
 * 
 */
class Cat_Model extends Public_Model
{
	protected $_table_name="category";

	public function __construct()
	{
		parent::__construct();
	}

	public function getCatid($key){
		$this->db->where('cat_url',$key);
		$this->db->select()->from($this->_table_name);
		$rows = $this->db->get()->num_rows();

		if($rows > 0){
			$this->db->where('cat_url',$key);
			$this->db->select()->from($this->_table_name);
			return $this->db->get()->row()->category_id;
		}else{
			return false;
		}
	}
	
	public function getCategory($key){
		$this->db->where('cat_url',$key);
		$this->db->select()->from($this->_table_name);
		$rows = $this->db->get()->num_rows();

		if($rows > 0){
			$this->db->where('cat_url',$key);
			$this->db->select()->from($this->_table_name);
			return $this->db->get()->row()->category;
		}else{
			return false;
		}
	}
	
}