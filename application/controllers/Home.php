<?php
class Home extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Seo_Model');
	}
	
	public function index(){
		$id=1;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['active'] = "Home";
		$this->data['subview'] = "public/Home/index";
		$this->load->view('public/_layout_main',$this->data);
	}

	public function quickstrips(){
		$id=8;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['active'] = "Quantiquik&trade; Quick Test Strips";
		$this->data['subview'] = "public/Home/quickstrips";
		$this->load->view('public/_layout_full',$this->data);
	}
	public function cookieset(){
		$status = $this->input->post('status');
		set_cookie('cookieMessage',$status,'3600');
	}
}