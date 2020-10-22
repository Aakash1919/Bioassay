<?php
class Category extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/MainCat_Model');
	}
	
	public function index(){
				$this->data['ProjectName'] = "Category|Admin|BioAssay System";
				$this->data['Active'] = "ManageCategory";
				$this->data['PageTitle'] = 'Main Category Details';
				$order='id';
                $format ='asc';
                $config['full_tag_open'] = '<div class="pagination"><ul class="pagination">';
                $config['full_tag_close'] = '</ul></div><!--pagination-->';
                
                $config['first_link'] = '&laquo; First';
                $config['first_tag_open'] = '<li class="prev page">';
                $config['first_tag_close'] = '</li>';
                
                $config['last_link'] = 'Last &raquo;';
                $config['last_tag_open'] = '<li class="next page">';
                $config['last_tag_close'] = '</li>';
                
                $config['next_link'] = 'Next &rarr;';
                $config['next_tag_open'] = '<li class="next page">';
                $config['next_tag_close'] = '</li>';
                
                $config['prev_link'] = '&larr; Previous';
                $config['prev_tag_open'] = '<li class="prev page">';
                $config['prev_tag_close'] = '</li>';
                
                $config['cur_tag_open'] = '<li class="active"><a href="">';
                $config['cur_tag_close'] = '</a></li>';
                
                $config['num_tag_open'] = '<li class="page">';
                $config['num_tag_close'] = '</li>';
                $config['base_url']= base_url()."admin/category/index";
                $config['total_rows'] = $this->MainCat_Model->Count();
                $config['per_page'] = 10;
                $config["uri_segment"] = 4;
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $this->data['items'] = $this->MainCat_Model->Get($config["per_page"], $page,$order,$format);
                $this->data["links"] = $this->pagination->create_links();
				$this->data['subview'] = "admin/Category/index";
				$this->load->view('admin/_layout_main',$this->data);
	}
	public function edit($id=null){
			$this->data['ProjectName'] = "Store|Admin|BioAssay System";
			$this->data['Active'] = "ManageCategory";

			if($this->input->post()){
				$id=$this->input->post('id');
				$MainCategoryArray = array('title'=>$this->input->post('title'),
											'description'=>$this->input->post('Description'),
										);
				$MCID = $this->MainCat_Model->Save($id,$MainCategoryArray);
				if(!empty($MCID)){
					$response = array('Response'=>1,'Message'=>"Category added/Edited Successfully");
 					 $this->session->set_flashdata('response',$response);
 					 redirect('/admin/category/edit/'.$MCID);
				}
			}
			$this->data['item']=$this->MainCat_Model->Getbyid($id);
			$this->data['subview'] = "admin/Category/edit";
			$this->load->view('admin/_layout_main',$this->data);
	}public function delete($id){
		$MCID = $this->MainCat_Model->delete($id);
		if(!empty($MCID)){
			$response = array('Response'=>1,'Message'=>"Category Deleted Successfully");
 					 $this->session->set_flashdata('response',$response);
 					 redirect('/admin/category/index');
			
		}
			
	}
}