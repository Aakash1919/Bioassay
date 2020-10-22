<?php
class Distributor_Model extends Members_Model{

	protected $_table_name = "distributor";

	public function __construct(){
		parent::__construct();
    }
    public function getDistributor($distributorName)
    {
        $this->db->where('continent',$distributorName);
        $this->db->select()->from($this->_table_name);
        $rows=$this->db->get()->num_rows();
        if($rows>0){
            $this->db->where('continent',$distributorName);
            $this->db->select()->from($this->_table_name);
            return $this->db->get()->result_array();
        }else{
            return false;
        }
    }
    public function getDistributorDetails($did){
        $this->db->where('distributor_id',$did);
        $this->db->select()->from($this->_table_name);
        $rows=$this->db->get()->num_rows();
        if($rows>0){
            $this->db->where('distributor_id',$did);
            $this->db->select()->from($this->_table_name);
            return $this->db->get()->result_array();
        }else{
            return false;
        } 
    }
}
?>