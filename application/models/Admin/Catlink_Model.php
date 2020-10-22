<?php

class Catlink_Model extends Admin_Model{

	protected $_table_name = "prod_cat_link";

	public function __construct(){
		parent::__construct();
	}
	 // public function Save($id,$data){
  //       if($id==NULL){
  //            $this->db->insert($this->_table_name,$data);
  //            $result = $this->db->insert_id();   
  //       }else{
  //           $this->db->where('product_id',$id);
  //           $this->db->update($this->_table_name,$data);
  //           $result = $id;
  //       }
  //       return $result;
  //   }
    public function Save($id,$data){
        $this->db->where('product_id',$id);
        $this->db->select()->from($this->_table_name);
        $row = $this->db->get()->num_rows();
        if($row==0){
             $this->db->insert($this->_table_name,$data);
             $result = $this->db->insert_id();   
        }else{
            $this->db->where('product_id',$id);
            $this->db->update($this->_table_name,$data);
            $result = $id;
        }
         return $result;
    }
    public function Delete($id){
        $this->db->where("product_id",$id);
        $this->db->delete($this->_table_name);
        return 1;
    }
}
