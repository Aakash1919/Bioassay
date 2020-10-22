<?php

class Category_Model extends Admin_Model{

	protected $_table_name = "category";

	public function __construct(){
		parent::__construct();
	}
	 public function Save($id,$data){
        if($id==NULL){
            $this->db->insert($this->_table_name,$data);
            $result = $this->db->insert_id();
        }else{
            $this->db->where('category_id',$id);
            $this->db->update($this->_table_name,$data);
            $result = $id;
        }
        return $result;
    }
     public function Delete($id){
        $this->db->where("category_id",$id);
        $this->db->delete($this->_table_name);
        return 1;
    }
        public function GetAllParentCategories()
    {
        $this->db->select()->from('bioassy_catdetails');
        return $this->db->get()->result();
    }
}