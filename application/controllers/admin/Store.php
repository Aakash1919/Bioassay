<?php
class Store extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Store_Model');
		$this->load->model('Admin/Product_Model');
		$this->load->model('Admin/Order_Model');
		$this->load->model('Admin/Product_Meta');
		$this->load->model('Admin/Product_Extra');
		$this->load->model('Admin/RP_Model');
		$this->load->model('Admin/Catlink_Model');
		$this->load->model('Admin/Category_Model');
	}
	
	public function categories(){
		$this->data['ProjectName'] = "Store|Admin|BioAssay System";
		$this->data['PageTitle'] = 'Category Management';
		$this->data['Active'] = "store_categories";
				$order='category_id';
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
                $config['base_url']= base_url()."admin/store/categories";
                $config['total_rows'] = $this->Store_Model->Count();
                $config['per_page'] = 10;
                $config["uri_segment"] = 4;
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $this->data['items'] = $this->Store_Model->Get($config["per_page"], $page,$order,$format);
                $this->data["links"] = $this->pagination->create_links();	
		$this->data['subview'] = "admin/Store/index";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function products()
	{
		$this->data['ProjectName'] = "Store|Admin|BioAssay System";
		$this->data['PageTitle'] = 'Product Management';
		$this->data['Active'] = "store_products";
		$order='products.product_id';
                $format ='asc';
                $config['per_page'] = 10;
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        		if($this->input->get()){
        			$search = $this->input->get('search');
        			$config['total_rows'] = $this->Product_Model->sCount($search);
        			 $this->data['items'] = $this->Product_Model->sGet($config["per_page"], $page,$order,$format,$search);
               
                
        		}else{

        			$config['total_rows'] = $this->Product_Model->Count();
        			 $this->data['items'] = $this->Product_Model->Get($config["per_page"], $page,$order,$format);
               
                
        		}
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
                $config['base_url']= base_url()."admin/store/products";
                $config["uri_segment"] = 4;
                $this->pagination->initialize($config);
                $this->data["links"] = $this->pagination->create_links();	
		$this->data['subview'] = "admin/Store/products";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function ordermanagement()
	{
		$this->data['ProjectName'] = "Store|Admin|BioAssay System";
		$this->data['PageTitle'] = 'Order Management';
		$this->data['Active'] = "store_order_management";
		$order='orders_id';
		$format ='desc';
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
		$config['total_rows'] = $this->Order_Model->Count();
		$config['per_page'] = 10;
		$config["uri_segment"] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->data['items'] = $this->Order_Model->Get($config["per_page"], $page,$order,$format);
		$this->data["links"] = $this->pagination->create_links();	
		$this->data['subview'] = "admin/Store/ordermanagement";
		$this->load->view('admin/_layout_main',$this->data);
	}
	public function edit($type,$id=null)
	{
		if($type=='category'){
			$this->data['ProjectName'] = "Store|Admin|BioAssay System";
			$this->data['Active'] = "store_categories";
			if($this->input->post())
			{
				$categoryArray = array(
								'catid'=>$this->input->post('pCategory'),
								'category'=>$this->input->post('subCategory'),
								'display_name'=>$this->input->post('subCategory'),
								'mod_date'=>date('Y-m-d',time()),
								'cat_url'=>str_replace(' ', '-', $this->input->post('subCategory'))
									);
				$cID = $this->Category_Model->Save($id,$categoryArray);
				if($cID){
					 $response = array('Response'=>1,'Message'=>"Category added/Edited Successfully");
 					 $this->session->set_flashdata('response',$response);
					redirect('/admin/store/edit/category/'.$cID);
				}
			}
			$this->data['parentCategory']=$this->Category_Model->GetAllParentCategories();
			$this->data['item']=$this->Store_Model->Getbyid($id);
			$this->data['subview'] = "admin/Store/editCategory";
			$this->load->view('admin/_layout_main',$this->data);
		}
		if($type=='products'){
			$this->data['ProjectName'] = "Store|Admin|BioAssay System";
			$postData = $this->input->post();
			if($postData){
				// echo "<pre>";
				// print_r($_POST);
				// echo "</pre>";
				$id = $this->input->post('id');
				$productArray =array(
									'name'=>$this->input->post('pName'),
									'url'=>$this->input->post('Url'),
									'name_display'=>$this->input->post('pDisplayName'),
									'price'=>$this->input->post('pPrice'),
									'catalog_num'=>$this->input->post('catalog'),
									'discountcode'=>$this->input->post('DiscountCode'),
									'discountpercent'=>$this->input->post('DiscountPercent'),
									'shipping_method'=>$this->input->post('sMethod'),
									'seo_title'=>$this->input->post('MetaTitle'),
									'seo_keyword'=>$this->input->post('MetaKeywords'),
									'seo_description'=>$this->input->post('MetaDescription'),
									'in_stock' => $this->input->post('in_stock'),
									'expirydate'=>$this->input->post('eDate')
								);
				$productID = $this->Product_Model->Save($id,$productArray);
				if(!empty($productID)){
					$procatArray = array(
									'product_id'=>$productID,
									'category_id'=>$this->input->post('pcategory'),
									'mod_date'=>date('Y-m-d',time())
										);

					$this->Catlink_Model->Save($productID,$procatArray);

					$productMetaArray = array(
										'product_id'=>$productID,
										'keywords'=>$this->input->post('keyForSearching'),
										'description'=>$this->input->post('pDescription'),
										'shipment'=>$this->input->post('Shipment'),
										'storage'=>$this->input->post('pStorage'),
										'mod_date'=>date('Y-m-d',time())
										  );
					$this->Product_Meta->Save($productID,$productMetaArray);
				
					if(!empty($_FILES['pdf']['name'])){
					
						$pdfResponse = $this->uploadFiles($productID,'pdf');
						if(!empty($pdfResponse)){
							$pdfName = $pdfResponse['upload_data']['file_name'];
							$pdfNameWithoutextension =explode('.', $pdfName);
							$ProductMetaPDF = array(
												'protocol'=>$pdfName,
												'msds'=>$pdfNameWithoutextension[0].'-MSDS.pdf'
											);
							
						$this->Product_Meta->Save($productID,$ProductMetaPDF);
					
						}	

					}
					if(!empty($_FILES['pImage']['name'])){
							//Need to make Image uploading functions after that (done)
							$ImageResponse = $this->uploadFiles($productID,'pImage');

							if(!empty($ImageResponse)){
								$ProductMetaImage = array(
													'product_figure'=>$ImageResponse['upload_data']['file_name']
													);
							$this->Product_Meta->Save($productID,$ProductMetaImage);		
							}
						
					}
					
					$productExtraArray = array(
											'product_id'=>$productID,
											'faq'=>$this->input->post('FAQ'),
											'citations'=>$this->input->post('citation'),
											'general'=>$this->input->post('GQuestions'),
											'service'=>$this->input->post('pName'),
											);	
				     $this->Product_Extra->Save($productID,$productExtraArray);//This Product_Extra Model needed to be made Aakash

					$relatedProducts = $this->input->post('relatedProducts');

					//Need to delete already existing related products first
					if(!empty($relatedProducts)){
					$this->deleteRelatedProducts($productID);

					foreach ($relatedProducts as $rp=>$value) {						
					
						$relatedProductArray = array(
												'parent_product_id'=>$productID,
												'related_product_id'=>$value
													);	

					$this->RP_Model->Save(null,$relatedProductArray);//RP_Model need to be made 
					}

					}
					 $response = array('Response'=>1,'Message'=>"Product Operation(Add/Edit) Successful.");
 					 $this->session->set_flashdata('response',$response);
 					 redirect('/admin/store/edit/products/'.$productID);

				}else{
					 $response = array('Response'=>0,'Message'=>"Product Operation(Add/Edit) Failed.");
 					 $this->session->set_flashdata('response',$response);
					redirect('/admin/store/edit/products/'.$productID);
			}
			}
			$this->data['parentCategory']=$this->Store_Model->GetAllParentCategories();
			$this->data['productDetails']=$this->Product_Model->getByProductID($id);
			$this->data['relatedProducts']=$this->Product_Model->getrelatedproducts();
			$this->data['PageTitle'] = 'Add/Edit Products';
			$this->data['Active'] = "store_products";
			$this->data['subview'] = "admin/Store/editProducts";
			$this->load->view('admin/_layout_main',$this->data);
		}
	}
	public function deleteRelatedProducts($productID){

		$this->RP_Model->deleteRelatedProducts($productID);//This function need  to be made i RP_Model
	
	}
	public function delete($type,$id){
		if($type=='category'){
			$res = $this->Category_Model->Delete($id);
			if($res){
				 $response = array('Response'=>1,'Message'=>"Category Deleted Successful.");
 				$this->session->set_flashdata('response',$response);
 				 redirect('/admin/store/categories');
			}
		}
		if($type=='products'){
			$this->Product_Model->Delete($id);
			$this->Product_Meta->Delete($id);
			$this->Product_Extra->Delete($id);
			$this->RP_Model->Delete($id);
			$res = $this->Catlink_Model->Delete($id);
			if($res){
				 $response = array('Response'=>1,'Message'=>"Product Deleted Successful.");
 				$this->session->set_flashdata('response',$response);
 				 redirect('/admin/store/products');
			}
		}

	}
	public function uploadFiles($productID,$FileName){
				$config['upload_path']          = './images/Product_pics/';
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 100000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1920;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($FileName))
                {
                		 $response = array('Response'=>0,'Message'=>$this->upload->display_errors());
 					     $this->session->set_flashdata('response',$response);
                		redirect('/admin/store/edit/products/'.$productID);
                }else{
                	 $data = array('upload_data' => $this->upload->data());
                	 return $data;
                }
	}
	public function view($type,$id){
		if($type=='order'){
			$this->data['ProjectName'] = "Order|Store|Admin|BioAssay System";
			$this->data['PageTitle'] = 'View Order';
			$orderDetails =  $this->Order_Model->getOrderDetails($id);
			$this->data['orderDetails'] =$orderDetails;
			if(!empty($orderDetails)){
			$this->data['po_num'] = $this->Order_Model->getOrderExtraDetails($id,'tag','po_num');
			$this->data['subtotal'] = $this->Order_Model->getOrderExtraDetails($id,'tag','subtotal');
			$this->data['shippingfee'] = $this->Order_Model->getOrderExtraDetails($id,'tag','shippingfee');
			$this->data['tax'] = $this->Order_Model->getOrderExtraDetails($id,'tag','tax');
			$this->data['total'] = $this->Order_Model->getOrderExtraDetails($id,'tag','total');
		}
			$this->data['Active'] = "store_order_management";
			$this->data['subview'] = "admin/Store/viewOrder";
			$this->load->view('admin/_layout_main',$this->data);
		}
	}
}