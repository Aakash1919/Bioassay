<?php
class Services extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Services_Model');
	}
	
	public function index(){
		$id=1; 
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}

	public function analytical_services(){
			$id=2;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}

	public function assay_customization(){
			$id=3;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}

	public function assay_design_and_development(){
			$id=4;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function lead_discovery_services(){
			$id=5;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function multiplex_assay_services(){
			$id=6;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}	
	public function acetylcholinesterase_inhibitor_screening_service(){
			$id=7;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}	
	public function aldehyde_dehydrogenase_inhibitor_screening_service(){
			$id=8;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function ampk_phosphorylation_status_service(){
			$id=9;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function arginase_inhibitor_screening_service(){
			$id=10;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function erk_phosphorylation_status_service(){
			$id=11;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function filter_plate_solubility_service(){
			$id=12;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function in_vitro_cell_viability_service(){
			$id=13;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function monoamine_oxidase_inhibitor_screening_service(){
			$id=14;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function nfkb_phosphorylation_status_service(){
			$id=15;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function pampa_permeability_service(){
			$id=16;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function polylactate_assay_service(){
			$id=17;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function ptp1b_inhibitor_screening_service(){
			$id=18;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function shake_flask_solubility_service(){
			$id=19;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	public function admet_services(){
			$id=20;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}

	public function enzyme_inhibitor_screening(){
			$id=21;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}
	
	public function phosphorylation_status_screening(){
			$id=22;
		$this->data['keywords'] = $this->Services_Model->GetProperty('seo_keyword',$id);
		$this->data['description'] = $this->Services_Model->GetProperty('seo_description',$id);
		$this->data['active'] = $this->Services_Model->GetProperty('seo_title',$id);
		$this->data['subview'] = 'public/Services/'.$this->Services_Model->GetProperty('content',$id);
		$this->load->view('public/_layout_main',$this->data);
	}  
}