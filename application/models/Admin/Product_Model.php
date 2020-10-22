<?php

class Product_Model extends Admin_Model{

	protected $_table_name = "products";

	public function __construct(){
		parent::__construct();
	}
	public function sCount($keyword)
	{	
		$this->db->like('name_display',$keyword);
		// $this->db->join('product_meta','products.product_id=product_meta.product_id');
		// $this->db->join('product_Extra','products.product_id=product_Extra.product_id');
		$this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();

	}
	public function sGet($num,$start,$order,$format,$keyword){
		$this->db->like('name_display',$keyword);
		// $this->db->join('product_meta','products.product_id=product_meta.product_id');
		// $this->db->join('product_Extra','products.product_id=product_Extra.product_id');
		$this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
	}
		public function getrelatedproducts(){
		// $this->db->join('product_meta','products.product_id=product_meta.product_id');
		// $this->db->join('product_Extra','products.product_id=product_Extra.product_id');
		$this->db->select('products.product_id,name')->from($this->_table_name);
		return $this->db->get()->result();
	}
	public function getByProductID($id){
		$this->db->where('products.product_id',$id);
		$this->db->select()->from($this->_table_name);
		//$this->db->select('products.product_id,category_id,name,url,name_display,price,catalog_num,size,discountcode,discountpercent,shipping_method,seo_title,seo_keyword,seo_description,date,expirydate,keywords,description,protocol,citations,msds,shipment,storage,product_figure,product_meta.mod_date,faq,general,service')->from($this->_table_name);
		// $this->db->join('product_meta','products.product_id=product_meta.product_id');
		// $this->db->join('product_Extra','products.product_id=product_Extra.product_id');
		// $this->db->join('prod_cat_link','products.product_id=prod_cat_link.product_id');
		return $this->db->get()->result();
	}
	    public function Save($id,$data){
        if($id==NULL){
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