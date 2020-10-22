<?php
class Services extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Services_Model');
	}
	
	public function index(){
		$this->data['ProjectName'] = "Our Services|Admin|BioAssay System";
		$this->data['Active'] = "ManageServices";
		$this->data['PageTitle'] = 'Management';
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
                $config['base_url']= base_url()."admin/store/ordermanagement";
                $config['total_rows'] = $this->Services_Model->Count();
                $config['per_page'] = 10;
                $config["uri_segment"] = 4;
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $this->data['items'] = $this->Services_Model->Get($config["per_page"], $page,$order,$format);
                $this->data["links"] = $this->pagination->create_links();	
		$this->data['subview'] = "admin/Services/index";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function edit($id=null){
		$this->data['ProjectName'] = "Services|Admin|BioAssay System";
		$this->data['PageTitle'] = 'Add/Edit Services';
		$this->data['Active'] = "ManageServices";
		if($this->input->post()){
                        $id= $this->input->post('id');
			$ServicesArray = array(
                                        'title'=>$this->input->post('Title'),
                                        'content'=>$this->input->post('pDescription'),
                                        'seo_title'=>$this->input->post('MetaTitle'),
                                        'seo_keyword'=>$this->input->post('MetaKeywords'),
                                        'seo_description'=>$this->input->post('MetaDescription')
                                        );
                        $sID = $this->Services_Model->Save($id,$ServicesArray);
                        if(!empty($sID)){
                         $response = array('Response'=>1,'Message'=>"Service added/Edited Successfully");
                         $this->session->set_flashdata('response',$response);
                         redirect('/admin/services/edit/'.$sID);  
                        }
		}
		$this->data['Services'] = $this->Services_Model->Getbyid($id);
		$this->data['subview'] = "admin/Services/editServices";
		$this->load->view('admin/_layout_main',$this->data);
	}
        public function delete($id){
                $sID = $this->Services_Model->delete($id);
                        if(!empty($sID)){
                         $response = array('Response'=>1,'Message'=>"Service Deleted Successfully");
                         $this->session->set_flashdata('response',$response);
                         redirect('/admin/services/index');  
                        }
        }
}