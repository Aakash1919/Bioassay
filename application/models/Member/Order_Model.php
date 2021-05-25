<?php
class Order_Model extends Members_Model{

	protected $_table_name = "orders";

	public function __construct(){
		parent::__construct();
	}
	    public function Save($id,$data){
            if($id==NULL){
                $this->db->insert($this->_table_name,$data);
                $result = $this->db->insert_id();
            }else{
                $this->db->where('orders_id',$id);
                $this->db->update($this->_table_name,$data);
                $result = $id;
            }
            return $result;
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
?>