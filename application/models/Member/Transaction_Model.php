<?php
class Transaction_Model extends Members_Model{

	protected $_table_name = "transaction";

	public function __construct(){
		parent::__construct();
	}

	public function getPricebyOrderId($orderId = null) {
		$this->db->where('order_id', $orderId);
		$this->db->select('total_price')->from($this->_table_name);
		$result = $this->db->get()->results();
		return isset($result[0]->total_price) ? $result[0]->total_price : false;
	}
}
?>