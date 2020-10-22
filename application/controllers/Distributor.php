<?php
class Distributor extends Public_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->model('Member/Distributor_Model');
		$this->load->model('Admin/Seo_Model');
		
	}

	public function index(){
		$this->data['active'] = "Distributors";
		$id=9;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
        $this->data['AmericaDistributor']=$this->Distributor_Model->getDistributor('America');
        $this->data['EuropeDistributor']=$this->Distributor_Model->getDistributor('Europe');
        $this->data['AsiaDistributor']=$this->Distributor_Model->getDistributor('ASIA/PACIFIC');
        $this->data['MiddleEastDistributor']=$this->Distributor_Model->getDistributor('MIDDLE EAST');
        $this->data['AfricaDistributor']=$this->Distributor_Model->getDistributor('AFRICA');
		$this->data['subview'] = "public/Distributor/index";
		$this->load->view('public/_layout_main',$this->data);
    }
    public function getDistributor()
    {
        if($_POST['did']){ 
                        $did=$_POST['did'];
                        
                        $DistributorDetails=$this->Distributor_Model->getDistributorDetails($did); 
                        if(!empty($DistributorDetails)){
                        foreach($DistributorDetails as $fd){
                            
                            ?>

                    <span class="textbold_orange"><?php echo $fd['country'];?></span><br /><span class="bodytext"> 
                        
                    <?php if($fd['distributor']!=""){?></span><br />

                    <?php echo $fd['distributor'];?>

                    <?php
                       
                        }
                        else {?>
                    <br />Please choose a country! <br><br>
                    
                    <?php
                    }}}}
    }
}