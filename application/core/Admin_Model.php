<?php

class Admin_Model extends CI_Model
{
    protected $_table_name = "";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function Count(){
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();
    }
    
    public function Get($num,$start,$order,$format){
        $this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
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
    }
    public function GetById($id){
        $this->db->where('id',$id);
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->result();
    }
    public function Delete($id){
        $this->db->where("id",$id);
        $this->db->delete($this->_table_name);
        return 1;
    }
    public function GetAll(){
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->result();
    }
    
    
}

