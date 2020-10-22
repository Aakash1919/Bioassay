<?php

class MainCat_Model extends Admin_Model{

	protected $_table_name = "bioassy_catdetails";

	public function __construct(){
		parent::__construct();
	}
	 public function Save($id,$data){
        if($id==NULL){
            $this->db->insert($this->_table_name,$data);
            $result = $this->db->insert_id();
        }else{
            $this->db->where('id',$id);
            $this->db->update($this->_table_name,$data);
            $result = $id;
        }
        return $result;
    }}