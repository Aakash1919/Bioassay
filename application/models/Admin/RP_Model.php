<?php
class RP_Model extends Admin_Model{

	protected $_table_name = "related_products";

	public function __construct(){
		parent::__construct();
	}
	public function deleteRelatedProducts($productID){
		$this->db->where("parent_product_id",$productID);
        $this->db->delete($this->_table_name);
        return 1;
	}
	public function Delete($id){
        $this->db->where("parent_product_id",$id);
        $this->db->delete($this->_table_name);
        return 1;
    }
}