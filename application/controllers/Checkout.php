<?php
class Checkout extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Member/Auth_Model');
		$this->load->model('Public/Products_Model');
		$this->load->model('Member/Order_Model');
		$this->load->model('Member/Transaction_Model');
		$this->load->model('Member/OPLink_Model');
		$this->load->model('Member/OrderDetails_Model');
		$this->load->model('Member/TransactionResponse_Model');
		$this->load->model('Member/Authentication_Model');
	}

	public function index(){
		$this->data['active'] = "Cart";
		$this->data['subview'] = "public/Cart/index";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function CartTable(){
		$this->load->view('public/Cart/carttable');
	}
	public function addtocart(){
		
		if($this->input->post()){
			$productId = $this->input->post('product_id');
			if($this->Products_Model->checkInStock($productId)) {
				$response = array('Response'=>0,'Message'=>"Product is Out Of Stock.");
				$this->session->set_flashdata('response',$response);
				redirect($_SERVER['HTTP_REFERER']);
			}
			$data = array(
				'id' => $productId,
				'qty' => $this->input->post('quantity'),
				'price' => $this->input->post('price'),
				'catalog' => $this->input->post('catalog'),
				'shippingmt' => $this->input->post('ship'),
				'name' => str_replace(array( '(', ')' ), '', $this->input->post('name'))
			);
		   $result =	$this->cart->insert($data);
		
		   $pcode = $this->session->userdata('PromotionCode');
		   if(!empty($pcode)){
		   	$cart = $this->cart->contents();
		   	$response = $this->Products_Model->GetDiscountedPrice($pcode,$cart);
			if(empty($response)){
				//echo "Invalid Code";
			}else{
				$this->session->set_userdata('discount_data', $response);
			}
		   }	
			redirect('/checkout/index');
		}

	}
	public function delete(){
		$rowid = $_GET['rowid'];
		$data = array(
			'rowid'   => $rowid,
			'qty'     => 0
		);

		$this->cart->update($data);
		$this->session->unset_userdata('PromotionStatus');
		$this->session->unset_userdata('discountamount');
		$this->session->unset_userdata('PromotionCode');
		redirect('/checkout/index');
	}
	public function UpdateCartRow(){
		$row = $this->input->post('row');
		$quantity = $this->input->post('quantity');
		$data = array(
		    'rowid' => $row,
		    'qty'   => $quantity
		);
		$this->cart->update($data);
		echo 1;
	}
	public function update(){
		$data  = $_POST;

		foreach ($data as $key => $value) {
			if(!empty($value['rowid'])){
				$rowid = $value['rowid'];
				$qty = $value['qty'];
				if(!empty($rowid)){
					$data = array(
						'rowid'   => $rowid,
						'qty'     => $qty
					);
					$this->cart->update($data);
				}
			}
		}
		$pcode = $this->session->userdata('PromotionCode');
		   if(!empty($pcode)){
		   	$cart = $this->cart->contents();
		   	$response = $this->Products_Model->GetDiscountedPrice($pcode,$cart);
			if(empty($response)){
				//echo "Invalid Code";
			}else{
				$this->session->set_userdata('discount_data', $response);
			}
		   }	
		redirect('/checkout/index');
	}
	public function checkout()
	{
		$personID = $this->session->userdata('person_id');
		if(isset($personID)){
			$this->data['active'] = "Checkout";
			$this->data['userInfo'] =  $this->User_Model->GetAllUserDetailsByID($personID);
			$this->data['authprofileID'] = $this->User_Model->checkAuthProfileID($personID);
			$ccnumberdigit= $this->User_Model->lastfourdigit($personID);
			$this->data['cardfourdigit'] =substr($ccnumberdigit, -4); 
			$this->data['subview'] = "public/Cart/billingQoutation";
			$this->load->view('public/_layout_main',$this->data);
		}else{
			$fromCart = $this->input->get('fromCart');
			redirect('/user/login?fromcart='.$fromCart);
		}	
	}
	public function guestcheckout(){
			$this->data['active'] = "Guest Checkout";
			$this->data['subview'] = "public/Cart/billingQoutation";
			$this->load->view('public/_layout_main',$this->data);
	}
	
	public function billingQuotationProcess()
	{
	
		$sitekey =  $this->data['capcha_site_id'];
		if($this->input->post() || $_SESSION['PreviousInfo']){
			$personID = $this->session->userdata('person_id');
		if(isset($personID)){
			$this->data['active'] = "Checkout";
		}else{
			$this->data['active'] = "Guest Checkout";
		}
		
			$PostData = $this->input->post();
			$cart=$this->cart->contents();

			$Alameda_zip_arr = array("94501", "94502", "94536", "94538", "94539", "94541", "94542", "94544", "94545", "94546", "94550", "94551", "94552", "94555", "94560", "94566", "94568", "94577", "94578", "94579", "94580", "94586", "94587", "94588", "94601", "94602", "94603", "94605", "94606", "94607", "94608", "94609", "94610", "94611", "94612", "94615", "94617", "94618", "94619", "94621", "94702", "94703", "94704", "94705", "94706", "94707", "94708", "94709", "94710");
			if($PostData){
				$fedex_acct_num = $this->input->post('fedex_accnt');
				$fedex_service =$this->input->post('fedex_service');
				if (in_array($this->input->post('szip'), $Alameda_zip_arr) && empty($this->input->post('tax_exempt_id'))) {			
					$taxrate =  0.0975;	  
				 } else {
					 if (strtoupper($this->input->post('sstate'))=="CA" || strtoupper($this->input->post('sstate'))=="CALIFORNIA") {
						if(!empty($this->input->post('tax_exempt_id'))){
							
							$taxrate =  0;
						}else{
							$taxrate =  0.0725;
						}
					   
		  
					 }else{
						$taxrate =  0;
		   
					 }
					  					 
				}
				$this->session->set_userdata('PreviousInfo',$PostData);
			}
			if($_SESSION['PreviousInfo']){
				$PreviousInfo = $_SESSION['PreviousInfo'];
				$fedex_acct_num = $PreviousInfo['fedex_accnt'];
				$fedex_service =$PreviousInfo['fedex_service'];
				$taxrate = 0.0;
		
				if (in_array($PreviousInfo['szip'], $Alameda_zip_arr)) {
					$taxrate =  0.0975;
	  
				 } else {
					 if (strtoupper($PreviousInfo['sstate'])=="CA" || strtoupper($PreviousInfo['sstate'])=="CALIFORNIA") {
						if(!empty($PreviousInfo['tax_exempt_id'])){
							$taxrate =  0;
						}else{
							$taxrate =  0.0725;
						}
					   
		  
					 }else{
						$taxrate =  0;
					 }
					
				}
			}

			$shippingfee = $this->get_shipping_fee($fedex_acct_num, $fedex_service, $cart);
			
			$cart = $this->cart->contents();

			$discountamount = 0;
			$diss = $this->session->userdata('discount_data');
			if(!empty($diss)){
			foreach ($diss  as $d) {
				$status = $d['Status'];

					if($status == 'true'){
					$codedate = $d['Data'][0]->expirydate;
					if(empty($codedate)){
						$codedate = date('Y-m-d',time());
					}
					$expd = strtotime($codedate);
					$dtoday = time();
					
					if( $dtoday > $expd ){
						
					}else{
						$percentage = $d['Data'][0]->discountpercent;
						$productid = $d['Data'][0]->product_id;
						foreach($cart as $c){
							if($c['id']==$productid){
								$p = $c['price'];
								$a = (($p/100)*$percentage)*$c['qty'];
								$discountamount += $a;
							}
						}
					}
				}
			 }
										
			}
			$this->data['shippingfee'] = $shippingfee;
			$this->data['captcha_site_key']=$sitekey;
			
			if($discountamount !== 0){
				$newTaxTotal = $taxrate*($this->cart->total()-$discountamount);
				$this->data['tax'] =(float)$newTaxTotal;
				$this->data['total'] = $this->cart->total() + $this->data['tax'] + $this->data['shippingfee'] - $discountamount;
			}else{
				$this->data['tax'] =(float)$taxrate*$this->cart->total();
				$this->data['total'] = $this->cart->total() + $this->data['tax'] + $this->data['shippingfee'];				
			}
			if($this->input->post('payment_type')=="Credit Card"){
				$this->data['authToken'] = $token = self::generateAuthorizeToken($this->data['total'], $this->cart->contents());
			}
			$this->data['shippingFee'] = (float)$this->get_shipping_fee($fedex_acct_num, $fedex_service, $cart);
			$this->session->set_userdata('discountamount',$discountamount);
			$this->data['hostedAccessPaymentPage'] = $this->load->view('public/Modals/hostedAccessPaymentPage', NULL, TRUE);
		 	$this->data['subview'] = "public/Cart/billingQoutationProcess";
			$this->load->view('public/_layout_main',$this->data);	
		}
		
	}

	public function get_shipping_fee($fedex_acct_num, $fedex_service, $cart) {
		$shipping_fee = 0;
		$base_ice = 38.90;
		$base_RT = 18.90;
		if ($fedex_service == '2nd Day Air') 
		{
			$base_ice = 38.90;
			$base_RT = 18.90;

		} else if ($fedex_service == 'Standard Overnight')
		{
			$base_ice = 60.90;
			$base_RT = 40.90;

		} else if ($fedex_service == 'Priority Overnight')
		{
			$base_ice = 90.90;
			$base_RT = 50.90;
		}		
		$cnt_ice_prod = 0;
		$cnt_RT_prod = 0;

		foreach($cart as $prodid => $product) 
		{
			$qty=$product['qty'];
			$mmshipping_method=$product['shippingmt'];

			if ($mmshipping_method == 'On Ice') 
			{
				$cnt_ice_prod += $qty;

			} else if ($mmshipping_method == 'RT') {
				$cnt_RT_prod += $qty;
			}
		}
		if ( preg_match("/^[0-9]{9}$/", $fedex_acct_num) ) {
			if ($cnt_ice_prod > 0)
			{
				$shipping_fee += 20;
			}
			if ($cnt_RT_prod > 0) {
				$shipping_fee += 6;
			}
			return $shipping_fee;
		} 
		else {
			if ($cnt_ice_prod > 0) {
				$shipping_fee += $base_ice + $cnt_ice_prod * 6;
			}
			if ($cnt_RT_prod > 0) {
				$shipping_fee += $base_RT + $cnt_RT_prod * 6;
			}
			return $shipping_fee;
		}}

		public function getDiscount()
		{
			$discountPost=$this->input->post('discountcod');
			$cart = $this->cart->contents();
			if(!empty($discountPost))
			{
				$discountcod=$discountPost;
				$response = $this->Products_Model->GetDiscountedPrice($discountcod,$cart);
				if(empty($response)) {
					echo "Invalid Code";
				} else {
					$this->session->set_userdata('discount_data', $response);
					$this->session->set_userdata('PromotionStatus',true);
					$this->session->set_userdata('PromotionCode',$discountcod);
					$personID = $this->session->userdata('person_id');
					if(!empty($personID)){
						redirect('/checkout/checkout');
					}else{
						redirect('/checkout/guestcheckout');
					}
				}
			}
		}
		//function to remove promotion code
		public function removeDiscountCode(){
			//Unset promotion status
			$this->session->unset_userdata('discount_data');
			$this->session->unset_userdata('PromotionStatus');
			$this->session->unset_userdata('PromotionCode');
			$personID = $this->session->userdata('person_id');

			if(!empty($personID)){
				redirect('/checkout/billingQuotationProcess');
			}else{
				redirect('/checkout/guestcheckout');
			}
		}
		public function finalTransaction()
		{
		    if(!isset($_SESSION['PreviousInfo'])){
    			redirect('/checkout/checkout?fromCart=true');
    		}
			// $captcha_site_key = $this->data['capcha_site_key'];
			// if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
			// 	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$captcha_site_key.'&response='.$_POST['g-recaptcha-response']);
			// 	$responseData = json_decode($verifyResponse);
			
			// 	if(!$responseData->success){
			// 		$response = array('Response'=>0,'Message'=>"reCaptcha Verification failed.");
			// 		$this->session->set_flashdata('response',$response);
			// 		redirect('/checkout/billingQuotationProcess');
			// 	}
			// }else{
			// 	$response = array('Response'=>0,'Message'=>"Please select reCaptcha");
			// 	$this->session->set_flashdata('response',$response);
			// 	redirect('/checkout/billingQuotationProcess');
			// }
			// if(isset($_SESSION['PreviousInfo'])){
			// 	unset($_SESSION['PreviousInfo']);
			// }
				
			$postData = $this->input->post();
			$sessionData = $this->session->userdata;

			$cart = $this->cart->contents();
			$discountamount = $this->session->userdata('discountamount');
			if(!empty($discountamount)){
				$finalprice = $this->cart->format_number($this->cart->total()) - $discountamount;
			}else{
				$finalprice = $this->cart->format_number($this->cart->total());
			}
			if(isset($postData) && isset($sessionData) && $cart){
				$fedex_acct_num = $this->input->post('fedex_accnt');
				$fedex_service =$this->input->post('fedex_service');
				if($this->session->userdata('person_id')!=null){
					$personID = $this->session->userdata('person_id');
				
				}else{
				$personID = time();	
				}
				$orderData = array(
					'account_id'=>$personID,
					'orders_time'=>date('Y-m-d h:i:s',time()),
					'ordering_method'=>'web',
					'payment_method'=>'cc',
					'orders_status'=>'processing',
					'shipping_name'=>$this->input->post('sattn'),
					'shipping_co_name'=>$this->input->post('scompany'),
					'shipping_address_1'=>$this->input->post('saddr1'),
					'shipping_address_2'=>$this->input->post('saddr2'),
					'shipping_city'=>$this->input->post('scity'),
					'shipping_state'=>$this->input->post('sstate'),
					'shipping_zip'=>$this->input->post('szip'),
					'shipping_country'=>$this->input->post('scountry'),
					'shipping_tel'=>$this->input->post('sphone'),
					'shipping_email'=>$this->input->post('semail'),
					'tax_exempt'=>$this->input->post('tax_exempt_id'),
					'comment_'=>$this->input->post('cmnts'),

					'mod_date'=>date('Y-m-d',time()),

				);
				
				$orderID = $this->Order_Model->Save(null,$orderData);
				if(!empty($orderID)){
			
					$tramsactionData = array(
						'orders_id'=>$orderID,
						'transaction_time'=>date('Y-m-d h:i:s',time()),
						'total_price'=>$finalprice,
						'total_price_unit'=>'USD'
					);
					$TransactionID = $this->Transaction_Model->Save(null,$tramsactionData);
					$this->session->set_userdata('Transactiondb', $TransactionID);
			
					foreach ($cart as $c => $value) {
						if(!empty($value))
						{

							$prdt_id=$value['id'];
							$prdt_price=$value['price'];
						}
						$opLinkData = array(
							'orders_id'=>$orderID,
							'product_id'=>$prdt_id,
							'mod_date'=>date('Y-m-d',time())
						);
						$this->OPLink_Model->Save(null,$opLinkData);

						$orderDetailData = array(
							'orders_id'=>$orderID,
							'tag'=>'price_'.$prdt_id,
							'value'=>$prdt_price,
							'mod_date'=>date('Y-m-d',time())
						);
						$this->OrderDetails_Model->Save(null,$orderDetailData);
					}
			
  			//For tax rate and all other stuff
			$shippingfee = $this->get_shipping_fee($fedex_acct_num, $fedex_service, $cart);
		    $taxrate = 0.0;

		    $Alameda_zip_arr = array("94501", "94502", "94536", "94538", "94539", "94541", "94542", "94544", "94545", "94546", "94550", "94551", "94552", "94555", "94560", "94566", "94568", "94577", "94578", "94579", "94580", "94586", "94587", "94588", "94601", "94602", "94603", "94605", "94606", "94607", "94608", "94609", "94610", "94611", "94612", "94615", "94617", "94618", "94619", "94621", "94702", "94703", "94704", "94705", "94706", "94707", "94708", "94709", "94710");
			
					if (in_array($this->input->post('szip'), $Alameda_zip_arr) && empty($this->input->post('tax_exempt_id'))) {
					
						$taxrate =  0.0975;
		  
					 }else{
						if (strtoupper($this->input->post('sstate'))=="CA" || strtoupper($this->input->post('sstate'))=="CALIFORNIA") {
							if(!empty($this->input->post('tax_exempt_id'))){
								$taxrate =  0;
							}else{
								$taxrate =  0.0725;
							}		  
						}else{
						   $taxrate =  0;
						}
					 }
					//end
			  $newTotal = $this->cart->total()+($this->cart->total() * $taxrate)+$shippingfee;
			  $newTotal = number_format((float)$newTotal, 2, '.', '');
			  $this->session->set_userdata('newTotal', $newTotal);
		      $this->session->set_userdata('taxrate', $taxrate);
		      $this->session->set_userdata('shippingfee', $shippingfee);
					$ODdata1 = array(
						'orders_id'=>$orderID,
						'tag'=>'subtotal',
						'value'=>$this->cart->format_number($this->cart->total()),
						'mod_date'=>date('Y-m-d',time())

					);
					$ODdata2 = array(
						'orders_id'=>$orderID,
						'tag'=>'shippingfee',
						'value'=>$shippingfee,
						'mod_date'=>date('Y-m-d',time())

					);
					$ODdata3 = array(
						'orders_id'=>$orderID,
						'tag'=>'tax',
						'value'=>$taxrate,
						'mod_date'=>date('Y-m-d',time())

					);
					//$totalFull = $this->cart->format_number($this->cart->total())
					$ODdata4 = array(
						'orders_id'=>$orderID,
						'tag'=>'total',
						'value'=>$newTotal,
						'mod_date'=>date('Y-m-d',time())

					);
					$this->OrderDetails_Model->Save(null,$ODdata1);
					$this->OrderDetails_Model->Save(null,$ODdata2);
					$this->OrderDetails_Model->Save(null,$ODdata3);
					$this->OrderDetails_Model->Save(null,$ODdata4);
					$sessionperson = $this->session->userdata('person_id');

			
$cn = $this->input->post('scountry');
if($cn!="United States"){
	$updata =array('payment_method'=>"Quotation");
	$this->Order_Model->Save($orderID,$updata);
	
	//Quotation Email

	$emailbody1="";
	$emailbody1="Dear ".$this->input->post('sattn').",<br ><br >";
	$emailbody2="This is to confirm that we have received your quotation request #".$orderID.".  BioAssay Systems will email a detailed quote for your order including shipping/handling fee within 24 hours.<br ><br >";
	$emailbody3='';
	$emailbody3=$emailbody3."Quotation Request Details:<br ><br >";
	$po_num = $this->input->post('po_num');
	if(isset($po_num)){
		$emailbody3=$emailbody3."PO Number: ".$po_num."<br ><br >";
	}
	$kk=0;
	foreach($cart as $prodid => $product) 
	
	
	{
		$sumtot=0;
		if($product != null)
		{
			$quat = $product['qty'];
			$tot=$product['qty']*$prdt_price; 
			$sumtot=$sumtot+$tot;
	
			$kk++;
	
			$shipping_method= $product['shippingmt'];
			$pdt_price=$product['price'];
			$pdt_name=$product['name'];
			$catalogno=$product['catalog'];
			$discountcode=$this->session->userdata('PromotionCode');
		
			$emailbody3=$emailbody3."Product Name:     $pdt_name<br >Catalog No:        $catalogno<br >Shipping method:  $shipping_method<br >Price:           $". $pdt_price."<br >QTY:             $quat<br ><br >";
	
	
		}
		$emailbody3=$emailbody3.'<br>';
	}
	
	if($discountcode!=""){
		$discountamount = $this->session->userdata('discountamount');	
		$emailbody3=$emailbody3."Discount Code:    $discountcode<br > Discount Price:$".$discountamount."<br>";
	}
	$emailbody3=$emailbody3."Subtotal:        $".$finalprice."<br >";
	$emailbody3=$emailbody3."S/H:             TBD<br >";  
	if(!empty($this->input->post('tax_exempt_id'))){
		$emailbody3=$emailbody3."Tax Exempt Number: ".$this->input->post('tax_exempt_id')."<br/>";  
	}
	//$emailbody3=$emailbody3."Tax:             $".number_format($taxrate*($this->cart->total()),2)."<br >";
	
	$customrate = 0.00;
	
	if ($customrate>0)
	{
	
		$customamount = $this->cart->total() * $customrate;
		$emailbody3=$emailbody3."Custom Charge:\t$".sprintf("%0.2f",$customamount)."<br >";
			}
	$emailbody3=$emailbody3."Total:           TBD<br ><br >";
	
	if($shipping_method == "USPS") {
		if($this->input->post('scountry')=='United States'){
			$emailbody3=$emailbody3."Free 2-5 Day USPS Shipping<br ><br >";
		}else{
			$emailbody3=$emailbody3."International Shipping<br ><br >";
		}
	} else {
	
	
		if ($this->input->post('fedex_accnt')) {
			if ( preg_match("/^[0-9]{9}$/",$this->input->post('fedex_accnt')) ) {
				$emailbody3=$emailbody3."FedEx Acct #:    ".$this->input->post('fedex_accnt')."<br >";
	
			} else {
				$emailbody3=$emailbody3."FedEx Acct #:    ".$this->input->post('fedex_accnt')." Invalid, not counted for S&H fee calculation.<br >";
			}
		}

		if($this->input->post('scountry')=='United States'){
			$emailbody3=$emailbody3."FedEx Delivery:  ".$this->input->post('fedex_service')."<br ><br >";
		}else{
			$emailbody3=$emailbody3."International Shipping <br><br>";
		}
	}
	
	$emailbody3=$emailbody3."Ship to:<br ><br >".$this->input->post('sattn')."<br >";
	$emailbody3=$emailbody3.$this->input->post('scompany')."<br >";
	$emailbody3=$emailbody3.$this->input->post('saddr1')."<br >";
	$emailbody3=$emailbody3.$this->input->post('saddr2')."<br >";
	$emailbody3=$emailbody3.$this->input->post('scity').", ";
	$emailbody3=$emailbody3.$this->input->post('sstate')." ";
	$emailbody3=$emailbody3.$this->input->post('szip')."<br >";
	$emailbody3=$emailbody3.$this->input->post('scountry')."<br >";
	$emailbody3=$emailbody3.$this->input->post('sphone')." (tel)<br >";
	$emailbody3=$emailbody3.$this->input->post('semail')."<br ><br >";
	
	$emailbody3=$emailbody3."Bill to:<br ><br >".$this->input->post('battn')."<br >";
	$emailbody3=$emailbody3.$this->input->post('bcompany')."<br >";
	$emailbody3=$emailbody3.$this->input->post('baddr1')."<br >";
	$emailbody3=$emailbody3.$this->input->post('baddr2')."<br >";
	$emailbody3=$emailbody3.$this->input->post('bcity').", ";
	$emailbody3=$emailbody3.$this->input->post('bstate')." ";
	$emailbody3=$emailbody3.$this->input->post('bzip')."<br >";
	$emailbody3=$emailbody3.$this->input->post('bcountry')."<br >";
	$emailbody3=$emailbody3.$this->input->post('bphone')." (tel)<br >";
	$emailbody3=$emailbody3.$this->input->post('bfax')." (fax)<br ><br >";
	$emailbody3=$emailbody3."Notes:<br >".$this->input->post('cmnts')."<br ><br >";
	$emailbody3=$emailbody3."We thank you for your business!<br ><br >Your BioAssay Systems Team<br >";
	$emailbody=$emailbody1.$emailbody2.$emailbody3;
	   $email = $this->input->post('semail')."," ;
	   $email .="order@bioassaysys.com" .",";
	
	
	   $salesemail = "order@bioassaysys.com";
	   $emailtitle = "Order receipt - www.bioassaysys.com";
	   $header = "From: ".$salesemail."\r\n"; 
	   $header.= "MIME-Version: 1.0\r\n"; 
	   $header.= "Content-type: text/html; charset=utf-8\r\n";
	   mail($email,$emailtitle,$emailbody, $header);
	  


	//Quotation Email Close
	$responseText= "<span class=\"textbold\">An email has been sent to ".$this->input->post('semail')."</span><br><br><br >";
	 $response = array('Response'=>0,'Message'=>$responseText);
	 $this->session->set_flashdata('response',$response);
	 $pp=0;
	 $prods ='';
	 foreach($cart as $prodid => $product)
	{
		if($product != null)
		{		
			$quat = $product['qty'];
			$pdt_price=$product['price'];
			$pdt_name=$product['name'];
			$catalogno=$product['catalog'];
			$pp++;
			$prods = $prods."{
		   'sku': '".$catalogno."',
		   'name': '".$pdt_name."',
		   'price': ".number_format($pdt_price,2).",
		   'quantity': ".$quat."
	   },";	
		}
		
	};
	 
	 $this->session->set_flashdata('ecommerce',
	 "
   'transactionId': '".$orderID."',
   'transactionAffiliation': 'Quotation Request',
   'transactionTotal': ".number_format($finalprice,2).",
   'transactionProducts': [".$prods."]"
	 );
	 $this->cart->destroy();
	 redirect('/checkout/thanks');
}
if($this->input->post('payment_type')=="Purchase Order"){
	$updat =array('payment_method'=>"PO");
	$this->Order_Model->Save($orderID,$updat);
	$ODdata5 = array(
						'orders_id'=>$orderID,
						'tag'=>'po_num',
						'value'=>$this->input->post('po_num'),
						'mod_date'=>date('Y-m-d',time())

					);
	$this->OrderDetails_Model->Save(null,$ODdata5);
    
   //Purchase Order Email
   $emailbody1="";
$emailbody1="Dear ".$this->input->post('sattn').",<br ><br >";
$emailbody2="Your order #".$orderID." has been placed, please keep a record of this receipt.<br ><br >Payment Method: Purchase Order<br><br>";
$emailbody3='';
$emailbody3=$emailbody3."Order Details:<br ><br >";
$emailbody3="PO Number:       ".$this->input->post('po_num')."<br >";
$kk=0;
foreach($cart as $prodid => $product) {
	$sumtot=0;
	if($product != null)
	{
		$quat = $product['qty'];
		$tot=$product['qty']*$prdt_price; 
		$sumtot=$sumtot+$tot;

		$kk++;

		$shipping_method= $product['shippingmt'];
		$pdt_price=$product['price'];
		$pdt_name=$product['name'];
		$catalogno=$product['catalog'];
		$discountcode=$this->session->userdata('PromotionCode');
		
		$emailbody3=$emailbody3."Product Name:     $pdt_name<br >Catalog No:        $catalogno<br >Shipping method:  $shipping_method<br >Price:           $". $pdt_price."<br >QTY:$quat<br >";
		
		$emailbody3=$emailbody3.'<br>';
	}
}

   //loop ends

   if($discountcode!=""){
	$discountamount = $this->session->userdata('discountamount');	
	$emailbody3=$emailbody3."Discount Code:    $discountcode<br > Discount Price:$".$discountamount."<br>";
	$newTotal = $newTotal-$discountamount;
}
   $emailbody3=$emailbody3."Subtotal:        $".$finalprice."<br >";
   $emailbody3=$emailbody3."S/H:             $".number_format($shippingfee,2)."<br >";  
   if(!empty($this->input->post('tax_exempt_id'))){
		$emailbody3=$emailbody3."Tax Exempt Number: ".$this->input->post('tax_exempt_id')."<br/>";  
	}
   $emailbody3=$emailbody3."Tax:             $".number_format($taxrate*($this->cart->total()),2)."<br >";





$customrate = 0.00;

if ($customrate>0)
{

	$customamount = $this->cart->total() * $customrate;
	$emailbody3=$emailbody3."Custom Charge:\t$".sprintf("%0.2f",$customamount)."<br >";

}
$emailbody3=$emailbody3."Total:           $".$newTotal."<br ><br >";

if($shipping_method == "USPS") {
	$emailbody3=$emailbody3."Free 2-5 Day USPS Shipping<br ><br >";
} else {


	if ($this->input->post('fedex_accnt')) {
		if ( preg_match("/^[0-9]{9}$/",$this->input->post('fedex_accnt')) ) {
			$emailbody3=$emailbody3."FedEx Acct #:    ".$this->input->post('fedex_accnt')."<br >";

		} else {
			$emailbody3=$emailbody3."FedEx Acct #:    ".$this->input->post('fedex_accnt')." Invalid, not counted for S&H fee calculation.<br >";
		}
	}
	$emailbody3=$emailbody3."FedEx Delivery:  ".$this->input->post('fedex_service')."<br ><br >";
}

$emailbody3=$emailbody3."Ship to:<br ><br >".$this->input->post('sattn')."<br >";
$emailbody3=$emailbody3.$this->input->post('scompany')."<br >";
$emailbody3=$emailbody3.$this->input->post('saddr1')."<br >";
$emailbody3=$emailbody3.$this->input->post('saddr2')."<br >";
$emailbody3=$emailbody3.$this->input->post('scity').", ";
$emailbody3=$emailbody3.$this->input->post('sstate')." ";
$emailbody3=$emailbody3.$this->input->post('szip')."<br >";
$emailbody3=$emailbody3.$this->input->post('scountry')."<br >";
$emailbody3=$emailbody3.$this->input->post('sphone')." (tel)<br >";
$emailbody3=$emailbody3.$this->input->post('semail')."<br ><br >";
$emailbody3=$emailbody3."Notes:<br >".$this->input->post('cmnts')."<br ><br >";

$emailbody=$emailbody1.$emailbody2.$emailbody3;
   $email = $this->input->post('semail')."," ;
   $email .="order@bioassaysys.com" .",";


   $salesemail = "order@bioassaysys.com";
   $emailtitle = "Order receipt - www.bioassaysys.com";
   $header = "From: ".$salesemail."\r\n"; 
   $header.= "MIME-Version: 1.0\r\n"; 
   $header.= "Content-type: text/html; charset=utf-8\r\n";
   mail($email,$emailtitle,$emailbody, $header);





   //Close Purchase order Email
	$responseText = "<span class=\"textbold\">An email has been sent to ".$this->input->post('semail')."</span><br><br><br >";
	$response = array('Response'=>0,'Message'=>$responseText);
	$this->session->set_flashdata('response',$response);
	 $pp=0;
	 $prods ='';
	 foreach($cart as $prodid => $product)
	{
		if($product != null)
		{		
			$quat = $product['qty'];
			$pdt_price=$product['price'];
			$pdt_name=$product['name'];
			$catalogno=$product['catalog'];
			$pp++;
			$prods = $prods."{
		   'sku': '".$catalogno."',
		   'name': '".$pdt_name."',
		   'price': ".number_format($pdt_price,2).",
		   'quantity': ".$quat."
	   },";	
		}
		
	};
	 
	 $this->session->set_flashdata('ecommerce',
	 "
   'transactionId': '".$orderID."',
   'transactionAffiliation': 'Purchase Order',
   'transactionTotal': ".number_format($finalprice,2).",
   'transactionTax': ".number_format($taxrate*($this->cart->total()),2).",
   'transactionShipping': ".number_format($shippingfee,2).",
   'transactionProducts': [".$prods."]"
	 );
	$this->cart->destroy();
	redirect('/checkout/thanks');
}
	if($this->input->post('payment_type')=="Paypal"){
		$countryCode = $this->returnCountryCode($this->input->post('scountry'));
		
		$this->session->set_userdata('orderID', $orderID);
		$this->session->set_userdata('SHIPTONAME', $this->input->post('sattn'));
		$this->session->set_userdata('SHIPTOSTREET', $this->input->post('saddr1').', '.$this->input->post('saddr2'));
		$this->session->set_userdata('SHIPTOCITY', $this->input->post('scity'));
		$this->session->set_userdata('SHIPTOSTATE', $this->input->post('sstate'));
		$this->session->set_userdata('SHIPTOCOUNTRY', $countryCode);
		$this->session->set_userdata('SHIPTOZIP', $this->input->post('szip'));
		$this->session->set_userdata('SHIPTOPHONENUM', $this->input->post('sphone'));
		$this->session->set_userdata('po_num', $this->input->post('po_num'));
		$this->session->set_userdata('payEmail', $this->input->post('semail'));
		
		redirect('express_checkout/SetExpressCheckout');
	}
	if($this->input->post('payment_type')=="Credit Card"){
		$response  = self::getAuthorizeResponse($newTotal);
		die;
	}
}

}
}

public function getAuthorizeResponse($amount=0) {

	$token = self::generateAuthorizeToken($amount);
	$postField = "token=$token";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://test.authorize.net/payment/payment");
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $postField );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);

	curl_close ($ch);;
}


public function generateAuthorizeToken($amount=0, $items) {
	$token = $this->Authentication_Model->getAnAcceptPaymentPage($amount, $items);
	return $token;
}
public function destroycart(){
		$this->cart->destroy();
		$this->session->unset_userdata('discountamount');
		$url = base_url();
		redirect($url);
	}
	public function failed()
	{
		$this->data['active'] = "Cart";
		$this->data['subview'] = "public/Cart/failed";
		$this->load->view('public/_layout_main',$this->data);
	}
public function thanks()
{
		$this->cart->destroy();
	    $this->data['active'] = "Cart";
		$this->data['subview'] = "public/Cart/thanks";
		$this->load->view('public/_layout_main',$this->data);
}

public function GetAuthToken(){
	$this->data['authToken'] = self::generateAuthorizeToken($this->cart->total(), $this->cart->contents());
	$data = array('AuthToken'=>$this->data['authToken'],'Url'=>'https://test.authorize.net/payment/payment');
	echo json_encode($data,JSON_UNESCAPED_SLASHES);
}


public function returnCountryCode($countryNamePost){
	$countryvalue=array("US","AL","DZ","AS","AO","AI","AG","AR","AM","AW","AU","AT","AZ","BS","BH","BD","BB","BY","BE","BZ","BJ","BM","BT",
"BO","BL","BA","BW","BR","VG","BN","BG","BF","BI","KH","CM","CA","CV","KY","TD","CL","CN","CO","CG","CK","CR","HR","CB","CY","CZ","DK",
"DJ","DM","DO","EC","EG","SV","EE","ET","FJ","FI","FR","GF","PF","GA","GM","GE","DE","GH","GI","GR","GD","GP","GU","GT","GN","GW","GY",
"HT","HN","HK","HU","IS","IN","ID","IE","IL","IT","CI","JM","JP","JO","KZ","KE","KI","XK","XE","KW","KG","LA","LV","LB","LS","LT","LU","MK","MG",
"MW","MY","MV","ML","MT","MH","MQ","MR","MU","MX","MD","MN","MS","MA","MZ","NP","NL","NC","NZ","NI","NE","NG","MP","NO","OM","PK",
"PW","PA","PG","PY","PE","PH","PL","XP","PT","PR","QA","RE","RO","XC","RU","RW","XS","SA","SN","CS","SC","SG","SK","SI","SB","ZA","KR",
"ES","LK","NT","VI","EU","VI","KN","LC","MB","VI","VC","SR","SZ","SE","CH","SY","TJ","TW","TZ","TH","XN","TG","TO","VG","TT","XA","TN",
"TR","TM","TC","TV","UG","UA","VC","AE","GB","UY","VI","UZ","VU","VE","VN","VG","WF","WS","XY","YE","ZM","ZW");

$countryname=array("United States","Albania","Algeria","American Samoa",
"Angola","Anguilla","Antigua","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan",
"Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia",
"Bonaire","Bosnia Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi",
"Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo",
"Cook Islands","Costa Rica","Croatia","Curacao","Cyprus","Czech Republic",
"Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Estonia","Ethiopia","Fiji","Finland",
"France","French Guiana","French Polynesia",
"Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Grenada","Guadeloupe",
"Guam","Guatemala","Guinea","Guinea Bissau","Guyana",
"Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Ireland (Republic of)","Israel","Italy","Ivory Coast",
"Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo",
"Kosrae Island","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Lithuania","Luxembourg",
"Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta",
"Marshall Islands","Martinique","Mauritania","Mauritius","Mexico","Moldova","Mongolia","Montserrat","Morocco","Mozambique",
"Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Northern Mariana Islands","Norway",
"Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Ponape","Portugal","Puerto Rico",
"Qatar","Reunion","Romania","Rota","Russia","Rwanda","Saipan","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Singapore",
"Slovakia","Slovenia","Solomon Islands","South Africa","South Korea","Spain","Sri Lanka","St. Barthelemy","St. Croix","St. Eustatius",
"St. John","St. Kitts and Nevis","St. Lucia","St. Maarten","St. Thomas","St. Vincent and the Grenadines",
"Suriname","Swaziland","Sweden","Switzerland","Syria","Tadjikistan","Taiwan","Tanzania","Thailand","Tinian","Togo","Tonga","Tortola",
"Trinidad and Tobago","Truk","Tunisia","Turkey","Turkmenistan","Turks and Caicos","Tuvalu","Uganda","Ukraine","Union Island",
"United Arab Emirates","United Kingdom","Uruguay","US Virgin Islands","Uzbekistan","Vanuatu","Venezuela","Vietnam",
"Virgin Gorda","Wallis and Futuna","Western Samoa","Yap","Yemen","Zambia","Zimbabwe");
$newCountryArray = array();	
for($i=0;$i<sizeof($countryname); $i++){
	$newCountryArray[$countryvalue[$i]] = $countryname[$i];
	}
	return(array_search($countryNamePost, $newCountryArray));
}
}