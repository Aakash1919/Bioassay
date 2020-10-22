<?php

class Products_Model extends Public_Model{

	protected $_table_name = "products";
	protected $_table_name1 = "products";
	protected $_product_overview = "product_overview";
	
	public function __construct(){
		parent::__construct();
	}
	public function getOverview($id){
		$this->db->where('product_id',$id);
		$this->db->select()->from($this->_product_overview);
		$rows = $this->db->get()->num_rows();
		if($rows > 0){
			$this->db->where('product_id',$id);
			$this->db->select()->from($this->_product_overview);
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function getname($productid){
		$this->db->where('product_id',$productid);
		$this->db->select('name_display')->from($this->_table_name);
		return $this->db->get()->row()->name_display;
	}
	public function productCount($param){
		$this->db->like('catalog_num',$param);
		$this->db->or_like('keywords',$param);
		$this->db->or_like('name_display',$param);
		//$this->db->or_like('seo_keyword',$param);
		$this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();
	}
	public function GetbyParamProduct($num,$start,$order,$format,$param){
		$this->db->like('catalog_num',$param);
		$this->db->or_like('keywords',$param);
		$this->db->or_like('name_display',$param);
		//$this->db->or_like('seo_keyword',$param);
		$this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
    }
	public function pCount($param){
       	$this->db->where("FIND_IN_SET($param,REPLACE(category,' ','')) > 0");
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();
    }

    public function GetbyParam($num,$start,$order,$format,$param){
        $this->db->where("FIND_IN_SET($param,REPLACE(category,' ','')) > 0");
        $this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
    }

 	public function Get($num,$start,$order,$format){
        $id = $this->session->userdata('id');
        $this->db->join('product_meta','product_meta.product_id=products.product_id');
       	$this->db->join('product_Extra','product_Extra.product_id=products.product_id');
        $this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
    }
    public function Get1($num,$start,$order,$format){
        $this->db->select()->from($this->_table_name1)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
    }
    public function Count1(){
        $this->db->select()->from($this->_table_name1);
        return $this->db->get()->num_rows();
    } 
	
	public function GetbyUrl($url){
		$this->db->where('url',trim($url));
		$this->db->select()->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows > 0 ){
			$this->db->where('url',$url);
			$this->db->join('product_meta','product_meta.product_id=products.product_id');
       		$this->db->join('product_Extra','product_Extra.product_id=products.product_id');
			$this->db->select()->from($this->_table_name);
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function GetbyUrl1($url){
		$this->db->where('url',trim($url));
		$this->db->select()->from("products");
		$rows = $this->db->get()->num_rows();
		if($rows > 0 ){
			$this->db->where('products.url',$url);
			$this->db->select('products.*')->from("products");
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function GetIDbyUrl1($url){
		$this->db->where('url',trim($url));
		$this->db->select()->from("products");
		$rows = $this->db->get()->num_rows();
		if($rows > 0 ){
			$this->db->where('products.url',$url);
			$this->db->select('products.product_id')->from("products");
			return $this->db->get()->row()->product_id;
		}else{
			return false;
		}
	}
	public function getoverviewbyid($id){
		$this->db->where('product_id',$id);
		$this->db->select()->from('product_overview_n');

	}
	public function GetDiscountedPrice($discountcod,$cart)
	{	
		$flag=0;
		$msg="valid";
		$discountdata = array();
		$today = date('Y-m-d',time());
		$this->db->where('discountcode',$discountcod);
		$this->db->select('product_id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows>0)
		{
			foreach($cart as $product => $value) {
				$product_id = $value['id'];				
					$this->db->where('discountcode',$discountcod);
					$this->db->where('product_id',$product_id);
					$this->db->select('discountcode,expirydate,product_id,discountpercent')->from($this->_table_name);
					$result = $this->db->get()->result();
					if(!empty($result)){
						$status = 'true';
					}else{
						$status = 'false';
					}
					$discountdata[] = array('Product_Id'=>$product_id,'Status'=>$status,'Data'=>$result);
			}  
			return $discountdata;
		}
	}
	public function GetFAQ($id){
		$this->db->where('products.product_id',$id);
		$this->db->join('product_meta','product_meta.product_id=products.product_id');
       	$this->db->join('product_Extra','product_Extra.product_id=products.product_id');
		$this->db->select('products.product_id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows>0){
		$this->db->where('products.product_id',$id);
		$this->db->join('product_meta','product_meta.product_id=products.product_id');
       	$this->db->join('product_Extra','product_Extra.product_id=products.product_id');
		$this->db->select()->from($this->_table_name);
		return $this->db->get()->result_array();
		}else{
			return false;
		}
	}
	public function getrelated($id){
		$this->db->where('parent_product_id',$id);
		$this->db->select('related_products.parent_product_id,related_products.related_product_id,products.url,products.name_display')->from('related_products');
		$this->db->join('products',"products.product_id=related_products.related_product_id");
		$rows = $this->db->get()->num_rows();
		if($rows>0){
			$this->db->where('parent_product_id',$id);
			$this->db->select('related_products.parent_product_id,related_products.related_product_id,products.url,products.name_display')->from('related_products');
			$this->db->join('products',"products.product_id=related_products.related_product_id");
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function getfaqbyid($id){
		$this->db->where('product_id',$id);
		$this->db->select()->from("product_faq");
		$rows = $this->db->get()->num_rows();
		if($rows > 0 ){
			$this->db->where('product_id',$id);
			$this->db->select()->from("product_faq");
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function getcitbyid($id){
		$this->db->where('product_id',$id);
		$this->db->select()->from("product_citations");
		$rows = $this->db->get()->num_rows();
		if($rows > 0 ){
			$this->db->where('product_id',$id);
			$this->db->select()->from("product_citations");
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function getservicesbyid($id){
		$this->db->where('product_id',$id);
		$this->db->select()->from("assay_service");
		$rows = $this->db->get()->num_rows();
		if($rows > 0 ){
			$this->db->where('product_id',$id);
			$this->db->select()->from("assay_service");
			return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function GetNewPrice($discountcod,$productID)
	{
		$this->db->where('discountcode',$discountcod);
		$this->db->where('product_id',$productID);
		$this->db->select('product_id,price,discountpercent')->from($this->_table_name);
		$rows= $this->db->get()->num_rows();
	
		if($rows>0){
		$this->db->where('discountcode',$discountcod);
		$this->db->where('product_id',$productID);
		$this->db->select('product_id,price,discountpercent')->from($this->_table_name);
		$result = $this->db->get()->result_array();
		if(!empty($result)){
			$product_id = $result[0]['product_id'];
			$RealPrice = $result[0]['price']; 
			$discountPercent = $result[0]['discountpercent'];
			$newPrice = $RealPrice - ($RealPrice * ($discountPercent/100));
			$discountamount = $RealPrice * ($discountPercent/100);
			return $discountamount;		
		}
		}else{
			// $this->db->where('product_id',$productID);
			// $this->db->select('product_id,price,discountpercent')->from($this->_table_name);
			// $result = $this->db->get()->result_array();
			// if(!empty($result)){
			// 	$product_id = $result[0]['product_id'];
			// 	$RealPrice = $result[0]['price']; 
			// 	$discountPercent = $result[0]['discountpercent'];
			// 	$newPrice = $RealPrice - ($RealPrice * ($discountPercent/100));
			// 	return $newPrice;
			//}	
			return false;	
		}
		
	}
	public function Getctone()
	{
		//$sql = "select distinct(prod_cat_link.product_id),products.name_display,products.catalog_num,product_Extra.citations,products.name from prod_cat_link inner join products on products.product_id=prod_cat_link.product_id inner join product_Extra on products.product_id=product_Extra.product_id where (category_id='1' or category_id='2'  or category_id='3'  or category_id='4'  or category_id='5'  or category_id='6'  or category_id='7') and (name_display like 'A%' or name_display like 'B%' or name_display like 'C%')  order by name_display";
		$sql = "SELECT * FROM products WHERE name_display LIKE 'A%' OR name_display LIKE 'B%' OR name_display LIKE 'C%' ORDER BY name_display";
		$query = $this->db->query($sql);
		return $query->result_array(); 
	}
	public function Getcttwo(){
		//$sql = "select distinct(prod_cat_link.product_id),products.name_display,products.catalog_num,product_Extra.citations,products.name from prod_cat_link inner join products on products.product_id=prod_cat_link.product_id inner join product_Extra on products.product_id=product_Extra.product_id where (category_id='1' or category_id='2'  or category_id='3'  or category_id='4'  or category_id='5'  or category_id='6'  or category_id='7')and  (name_display like 'D%' or name_display like 'E%' or name_display like 'F%' or name_display like 'G%' or name_display like 'H%' or name_display like 'I%' or name_display like 'J%' or name_display like 'K%' or name_display like 'L%' or name_display like 'M%')  order by name_display";
		$sql = "SELECT * FROM products WHERE name_display LIKE 'D%' OR name_display LIKE 'E%' OR name_display LIKE 'F%' OR name_display LIKE 'G%' OR name_display LIKE 'H%' OR name_display LIKE 'I%' OR name_display LIKE 'J%' OR name_display LIKE 'K%' OR name_display LIKE 'L%' OR name_display LIKE 'M%' ORDER BY name_display";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function Getctthree()
	{
		//$sql = "select distinct(prod_cat_link.product_id),products.name_display,products.catalog_num,product_Extra.citations,products.name from prod_cat_link inner join products on products.product_id=prod_cat_link.product_id inner join product_Extra on products.product_id=product_Extra.product_id where (category_id='1' or category_id='2'  or category_id='3'  or category_id='4'  or category_id='5'  or category_id='6'  or category_id='7') and(name_display like 'N%' or name_display like 'O%' or name_display like 'P%' or name_display like 'Q%' or name_display like 'R%' or name_display like 'S%' or name_display like 'T%' or name_display like 'U%' or name_display like 'V%' or name_display like 'W%' or name_display like 'X%' or name_display like 'Y%' or name_display like 'Z%')  order by name_display";
		$sql = "SELECT * FROM products WHERE name_display LIKE 'N%' OR name_display LIKE 'O%' OR name_display LIKE 'P%' OR name_display LIKE 'Q%' OR name_display LIKE 'R%' OR name_display LIKE 'S%' OR name_display LIKE 'T%' OR name_display LIKE 'U%' OR name_display LIKE 'V%' OR name_display LIKE 'W%' OR name_display LIKE 'X%' OR name_display LIKE 'Y%' OR name_display LIKE 'Z%' ORDER BY name_display";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function select_citation_details($pid)
	{
		$this->db->where('products.product_id',$pid);
		//$this->db->join('product_meta','product_meta.product_id=products.product_id');
       	//$this->db->join('product_Extra','product_Extra.product_id=products.product_id');
		$this->db->select()->from($this->_table_name);
		return $this->db->get()->result_array();
	} 

}