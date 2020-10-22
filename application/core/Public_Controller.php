<?php
class Public_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Public/Products_Model');
		$this->load->model('Member/User_Model');
		$this->load->model('Member/BSDetail_Model');
		$this->load->library('encrypt');
		// development site keys
		$this->data['capcha_site_id'] = "6LdjPqUUAAAAAIRHkdsWonAKkwISiJrGwokC1hYM";
		$this->data['capcha_site_key'] = "6LdjPqUUAAAAAM5hvSRscbKt-Q2_ULy-esvBQl-M";
		// production site keys
		//  $this->data['capcha_site_id'] = "6LfZd7IUAAAAAP3ZUjOODyzOVbLo05kTtSSl9jpM";
		//  $this->data['capcha_site_key'] = "6LfZd7IUAAAAAFbESekhA3Ub-TQIZtmxZeY68qOA";
		
		//require_once(APPPATH.'libraries/authorize_sdk/vendor/autoload.php'); 
		//use net\authorize\api\contract\v1 as AnetAPI;
  		//use net\authorize\api\controller as AnetController;
		/* Live Authorize.net settings
		$this->data['loginid'] ='3F9eMpx9R';
        $this->data['transaction_key'] ='62fN5K2sXaR4m5k7';
        */
       

              /*Development Kapil*/ 
      // $x_login_key='7sXmC5C7t';
      // $x_tran_key='773R3ez9QtaN4AX5';
      /*Development Kapil*/ 

       /*Production Kapil*/ 
  //     	3F9eMpx9R
		// 24f5F8h7M95dsVvE

        $this->data['loginid'] ='3F9eMpx9R';   
        $this->data['transaction_key'] ='24f5F8h7M95dsVvE';
        /*Production Kapil*/ 

		$this->data['cartcount'] = $this->cart->total_items(); 
		//$this->data['cookieStatus'] = 'false';
		$this->data['cookieStatus'] = get_cookie('cookieMessage');
		
	}

}