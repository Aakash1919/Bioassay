<?php
class Login extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/UserOne_Model');
	}
	
	public function index(){
		$this->data['active'] = "Login | BioAssay System";
		$this->load->view('public/Home/login',$this->data);
	}
	public function loginA()
	{
		$postData = $this->input->post();
		if(!empty($postData)){
			$username = $this->input->post('username');
			$password = base64_encode($this->input->post('password'));
			if(!empty($username) && !empty($password)){
				$result = $this->UserOne_Model->login($username,$password);
				if($result==true)
				{
					redirect('/admin/dashboard/index');
				}else
				{
					$response = array('Response'=>0,'Message'=>"Invalid Email/Password");
                	$this->session->set_flashdata('response',$response);
                	redirect('/login/index');
				}

			}
		}

	}
	public function logout()
	{
		 $this->session->sess_destroy();
     	 redirect('/login/index');
	}
}


