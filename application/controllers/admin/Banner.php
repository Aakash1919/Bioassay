<?php
class Banner extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Banner_Model');
	}
	
	public function index(){
		$id=1;
		$this->data['ProjectName'] = "Banner|Admin|BioAssay System";
		$this->data['Active'] = "Banner";
		$this->data['ImageBanner'] = $this->Banner_Model->GetbyBannerid($id);
		$this->data['subview'] = "admin/Banner/index";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function uploadImage()
	{
		$id=1;
		if($_FILES['pImage']['name']){
			$imageName = $_FILES['pImage']['name'];
			$ImageResponse = $this->uploadFiles('pImage');

				if(!empty($ImageResponse)){
					$BannerArray = array(
										'image'=>$imageName
										);
				$res = $this->Banner_Model->Save($id,$BannerArray);		
				if($res){
						$response = array('Response'=>0,'Message'=>'Banner Uploaded Successfully');
 					    $this->session->set_flashdata('response',$response);
                		redirect('/admin/banner/index');
                
				}	
				}
			
		}	
	}
	public function uploadFiles($FileName){
				$config['upload_path']          = './images/';
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 100000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1920;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($FileName))
                {
                		 $response = array('Response'=>0,'Message'=>$this->upload->display_errors());
 					     $this->session->set_flashdata('response',$response);
                		redirect('/admin/banner/index');
                }else{
                	return true;
                }
	}
}