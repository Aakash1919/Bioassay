<?php
class Products extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Seo_Model');
        $this->load->model('Public/Cat_Model');
	}
	public function updateorder(){
        $status = $this->input->post('orderby');
        set_cookie('orderby',$status,'7200');
    }
    public function updatesort(){
        $status = $this->input->post('sort');
        set_cookie('sort',$status,'7200');
    }
	public function index(){
        $id=2;
        $this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
        $this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
    
	$this->data['active'] = "Products";
        $Getdata = $this->input->get();
        if($Getdata)
        {
                $key = $this->input->get('caturl');
                $param = $this->Cat_Model->getCatid($key);
				$this->data['category'] = $this->Cat_Model->getCategory($key);
        }else{
                $param = '';
				$this->data['category'] = '';
        }
        $order='name_display';
        $format ='ASC';
        //$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
        //$config['full_tag_close'] = '</ul></nav>';
        $config['full_tag_open'] = '<div class="pagination" style="align:center;float:right;"><span>';
        $config['full_tag_close'] = '</span></div>';
        
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<span class="page-item">';
        $config['first_tag_close'] = '</span>';
        
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<span class="page-item">';
        $config['last_tag_close'] = '</span>';
        
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<span class="page-item">';
        $config['next_tag_close'] = '</span>';
        $config['reuse_query_string'] = true;
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<span class="page-item">';
        $config['prev_tag_close'] = '</span>';
        $config['attributes'] = array('class' => 'page-link');
        $config['cur_tag_open'] = '<span class="current"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></span>';
        
        $config['num_tag_open'] = '<span class="page-item">';
        $config['num_tag_close'] = '</span>';
        $config['base_url']= base_url()."products/index";
        if($Getdata){
            $config['total_rows'] = $this->Products_Model->pCount($param);
        }else{
            $config['total_rows'] = $this->Products_Model->Count1();
        
        }
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            if($Getdata){
                $this->data['items'] = $this->Products_Model->GetbyParam($config["per_page"], $page,$order,$format,$param);
                }else{
                $this->data['items'] = $this->Products_Model->Get1($config["per_page"], $page,$order,$format);    
            }
        $this->data["links"] = $this->pagination->create_links();
        $this->data['count'] = $config['total_rows'];
	    $this->data['subview'] = "public/Products/index";
	    $this->load->view('public/_layout_main',$this->data);
        }
        public function search(){
                $id=2;
                $this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
                $this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
            
                $this->data['active'] = "Products";
                $Getdata = $this->input->get();
               
                if($this->input->get('sitesearch')=='www'){
                        redirect('https://www.google.com/search?q=site%3Awww.bioassaysys.com%20'.$this->input->get('q'));
                }
                if($Getdata)
                {
                        $param = $this->input->get('q');
                }else{
                        $param = '';
                }
                $order='name_display';
                $format ='ASC';
                //$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
                //$config['full_tag_close'] = '</ul></nav>';
                $config['full_tag_open'] = '<div class="pagination" style="align:center;float:right;"><span>';
                $config['full_tag_close'] = '</span></div>';
                
                $config['first_link'] = '&laquo; First';
                $config['first_tag_open'] = '<span class="page-item">';
                $config['first_tag_close'] = '</span>';
                
                $config['last_link'] = 'Last &raquo;';
                $config['last_tag_open'] = '<span class="page-item">';
                $config['last_tag_close'] = '</span>';
                
                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<span class="page-item">';
                $config['next_tag_close'] = '</span>';
                $config['reuse_query_string'] = true;
                $config['prev_link'] = 'Previous';
                $config['prev_tag_open'] = '<span class="page-item">';
                $config['prev_tag_close'] = '</span>';
                $config['attributes'] = array('class' => 'page-link');
                $config['cur_tag_open'] = '<span class="current"><a class="page-link" href="#">';
                $config['cur_tag_close'] = '</a></span>';
                
                $config['num_tag_open'] = '<span class="page-item">';
                $config['num_tag_close'] = '</span>';
                $config['base_url']= base_url()."products/search";
                if($Getdata){
                $config['total_rows'] = $this->Products_Model->productCount($param);
                
                }else{
                $config['total_rows'] = $this->Products_Model->Count();
                
                }
                $config['per_page'] = 20;
                $config["uri_segment"] = 3;
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                if($Getdata){
                 $this->data['items'] = $this->Products_Model->GetbyParamProduct($config["per_page"], $page,$order,$format,$param);
                }else{
                $this->data['items'] = $this->Products_Model->Get($config["per_page"], $page,$order,$format);
                        
                }
                $this->data["links"] = $this->pagination->create_links();
                $this->data['count'] = $config['total_rows'];
                $this->data['subview'] = "public/Products/index";
                $this->load->view('public/_layout_main',$this->data);  
        }
    public function details($url){
	    $this->data['active'] = "Products";
        $this->data['item'] = $this->Products_Model->GetbyUrl1($url);
        $itm = $this->data['item'];
        if(!empty($itm)){
            foreach($itm as $it){
                $this->data['active'] = $it->seo_title;
                $this->data['keywords'] = $it->seo_keyword ;
                $this->data['description'] =  $it->seo_description ;
				#added by WC200615 for google structured data in head section
				$this->data['prodprice'] =  $it->price ;
				$this->data['prodfig'] =  $it->product_figure ;
				$this->data['prodname'] =  $it->name ;
				$this->data['produrl'] =  $it->url ;
				$this->data['prodsku'] =  $it->catalog_num ;
            }
        }
        $id = $this->Products_Model->GetIDbyUrl1($url);

        $d = $this->Products_Model->GetbyUrl1($url);
        if(empty($d)){
			#disabled by WC200214, not necessary
            #$this->session->set_flashdata('wrongproduct', 'Sorry this product does not exits');
            redirect('/products');
        }
        $this->data['subview'] = "public/Products/details";
        $this->load->view('public/_layout_rightbar',$this->data);
     }
}