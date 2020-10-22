<?php

class Product_Meta extends Admin_Model{

	protected $_table_name = "product_meta";

	public function __construct(){
		parent::__construct();
	}
	 public function Save($id,$data){
	 	$this->db->where('product_id',$id);
	 	$this->db->select('id')->from($this->_table_name);
	 	$rows = $this->db->get()->num_rows();
	 	if($rows>0){
	 		$this->db->where('product_id',$id);
            $this->db->update($this->_table_name,$data);
            $result = $id;
	 	}else{
	 		  $this->db->insert($this->_table_name,$data);
              $result = $this->db->insert_id();   
	 	}
        return $result;
    }
      public function Delete($id){
        $this->db->where("product_id",$id);
        $this->db->delete($this->_table_name);
        return 1;
    }
}