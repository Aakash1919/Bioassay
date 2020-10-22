<?php
class Dashboard extends Admin_Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->data['ProjectName'] = "Dashbard|Admin|BioAssay System";
		$this->data['Active'] = "Dashboard";
		$this->data['subview'] = "admin/Dashboard/index";
		$this->load->view('admin/_layout_main',$this->data);
	}
}