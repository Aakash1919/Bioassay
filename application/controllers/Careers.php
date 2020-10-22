<?php
class Careers extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Seo_Model');
	}
	
	public function index(){
		$this->data['active'] = "Careers";
		$id=6;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Careers/index";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function career_LT001(){
		$this->data['active'] = "Careers";
		$id=6;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Careers/caLT001";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function career_AD_RA(){
		$this->data['active'] = "Careers";
		$id=6;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Careers/caone";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function career_Manu_RA(){
		$this->data['active'] = "Careers";
		$id=6;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Careers/catwo";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function career_website_specialist(){
		$this->data['active'] = "Careers";
		$id=6;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Careers/cathree";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function career_sales_associate(){
		$this->data['active'] = "Careers";
		$id=6;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['subview'] = "public/Careers/cafour";
		$this->load->view('public/_layout_main',$this->data);
	}
}