<?php
class Users extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Member/User_Model');
                $this->data['ProjectName'] = "Dashbard|Admin|BioAssay System";
	}
	
	public function index(){
		$this->data['ProjectName'] = "Dashbard|Admin|BioAssay System";
		$this->data['Active'] = "Users-All";
                $this->data['PageTitle'] = 'Users Management';
		$order='person_id';
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
        $config['base_url']= base_url()."admin/users/index";
        $config['total_rows'] = $this->User_Model->Count();
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['items'] = $this->User_Model->Get($config["per_page"], $page,$order,$format);
        $this->data["links"] = $this->pagination->create_links();	
		$this->data['subview'] = "admin/Users/index";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function view($id=null){
		$this->data['ProjectName'] = "Dashbard|Admin|BioAssay System";
		$this->data['userDetails'] = $this->User_Model->GetAllUserDetailsByID($id);
		$this->data['Active'] = "Users-All";
		$this->data['subview'] = "admin/Users/viewUser";
		$this->load->view('admin/_layout_main',$this->data);	
	}
	public function changepassword(){
                $this->load->model('Admin/Admin_User');
               $this->data['Active'] = "Users-All";
             
                if($_POST){
                        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
                        $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[password]',array('required' => 'You must provide a %s.'));
                         if ($this->form_validation->run() == FALSE)
                                {
                                       //Error
                                        $this->data['response'] = validation_errors();
                                }
                                else
                                {
                                        $password = $this->input->post('password');
                                        $id = $this->session->userdata('id');
                                        $r = $this->Admin_User->updatepassword($id,$password);
                                        if($r==1){
                                                $this->data['response'] = "Password Updated Successfully";
                                        }
                                       //Success

                                }
                }
                $this->data['subview'] = "admin/Users/changepassword";
                $this->load->view('admin/_layout_main',$this->data);    
        }
}

