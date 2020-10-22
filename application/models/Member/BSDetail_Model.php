<?php
class BSDetail_Model extends Members_Model{

	protected $_table_name = "user_meta";

	public function __construct(){
		parent::__construct();
	}
	public function getLastFourDigit($personID){
		$this->db->where('person_id',$personID);
		$this->db->select('cc_numb')->from($this->_table_name);
		$rows  =$this->db->get()->num_rows();
		if($rows==1){
			$this->db->where('person_id',$personID);
			$this->db->select('cc_numb')->from($this->_table_name);
			return $this->db->get()->row()->cc_numb;		
		}else{
			return false;
		}
	}
}
?>