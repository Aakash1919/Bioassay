<?php
class Paypal_transaction extends Members_Model{

	protected $_table_name = "Paypal_transaction";

	public function __construct(){
		parent::__construct();
	}
	public function checkpayer($transactionId){
		$this->db->where('Paypal_TransactionID',$transactionId);
		$this->db->select('id')->from($this->_table_name);
		$rows= $this->db->get()->num_rows();
		if($rows>0){
			return true;
		}else{
			return false;
		}
	}
}
?>