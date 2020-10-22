<?php
class Seo extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Seo_Model');
	}
	
	public function index(){
		$this->data['ProjectName'] = "Seo|Admin|BioAssay System";
		$this->data['PageTitle'] = "Seo Management";
		$this->data['Active'] = "SEO";
		$this->data['items'] = $this->Seo_Model->GetAll();
		$this->data['subview'] = "admin/seo/index";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function edit($id=null){
		$this->data['ProjectName'] = "Seo-Edit|Admin|BioAssay System";
		$this->data['PageTitle'] = "Edit SEO";
		$this->data['Active'] = "SEO";
		if($id==null){
			redirect('/admin/seo/index');
		}
		if($_POST){
			$id = $this->input->post('id');
			$data = array(
					'Name'=>$this->input->post('pageName'),
					'Title'=>$this->input->post('Keyword'),
					'Description'=>$this->input->post('Description'),
				);
			$result = $this->Seo_Model->Save($id,$data);
			if(!empty($result)){
				$response = array('Response'=>1,'Message'=>"Seo Keywords and Description Saved successfully.");
                $this->session->set_flashdata('response',$response);
				redirect('admin/seo/edit/'.$id);
			}
		}
		$this->data['item'] = $this->Seo_Model->GetById($id);
		$this->data['subview'] = "admin/seo/edit";
		$this->load->view('admin/_layout_main',$this->data);	
	}
}