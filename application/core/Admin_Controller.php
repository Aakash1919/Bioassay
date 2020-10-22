<?php
class Admin_Controller extends Member_Controller{

	public function __construct(){
		parent::__construct();
			$userid = $this->session->userdata('id');
         $exception_uris = array('/login/index');
        if(in_array(uri_string(),$exception_uris)== FALSE){
            if(empty($this->session->userdata['id'])){ 
                redirect('/login/index');
            }
	}
	}
	
}