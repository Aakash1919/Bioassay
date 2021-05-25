<?php

class Order_Model extends Admin_Model{

	protected $_table_name = "orders";

	public function __construct(){
		parent::__construct();
	}
	public function getOrderDetails($id)
	{
		$this->db->where('orders.orders_id',$id);
		$this->db->select()->from($this->_table_name);
		$rows =$this->db->get()->num_rows();
		if($rows>0){
		$this->db->where('orders.orders_id',$id);
		$this->db->join('op_link','op_link.orders_id=orders.orders_id');
		$this->db->join('products','op_link.product_id=products.product_id');
		$this->db->select('orders.*,products.name,products.product_id,products.price,products.catalog_num')->from($this->_table_name);
		return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function getOrderExtraDetails($id,$property,$propertyValue){
		$this->db->where('orders_id',$id);
		$this->db->select()->from('orders_details');
		$rows =$this->db->get()->num_rows();
		if($rows>0){
		$this->db->where('orders_id',$id);
		$this->db->where($property,$propertyValue);
		$this->db->select()->from('orders_details');
		return @$this->db->get()->row()->value;
		}else{
			return false;
		}
	}
}