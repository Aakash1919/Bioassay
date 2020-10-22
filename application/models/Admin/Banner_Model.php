<?php
class Banner_Model extends Admin_Model{

	protected $_table_name = "bioassy_banner";

	public function __construct(){
		parent::__construct();
	}
	public function GetbyBannerid($id){
		$this->db->where('id',$id);
		$this->db->select('id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows>0){
			$this->db->where('id',$id);
			$this->db->select()->from($this->_table_name);
			return $this->db->get()->row()->image;
		}else{
			return false;
		}
		}
}
?>