<?php
class Order extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Seo_Model');
	}
	
	public function index(){
		$this->data['active'] = "Order";
		$id=4;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Order/index";
		$this->load->view('public/_layout_main',$this->data);
	}
}