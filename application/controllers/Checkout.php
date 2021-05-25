<?php
class Checkout extends Public_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model('Member/Auth_Model');
		$this->load->model('Public/Products_Model');
		$this->load->model('Member/Order_Model');
		$this->load->model('Member/Transaction_Model');
		$this->load->model('Member/OPLink_Model');
		$this->load->model('Member/OrderDetails_Model');
		$this->load->model('Member/TransactionResponse_Model');
		$this->load->model('Member/Authentication_Model');
		$this->load->model('Member/PaypalPayflow');
	}
	/*
	* Function to load main cart page 
	*/
	public function index() {
		$this->data['active'] = "Cart";
		$this->data['subview'] = "public/Cart/index";
		$this->load->view('public/_layout_main',$this->data);
	}
	/*
	* Function to load cart table view
	*/
	public function CartTable() {
		$this->load->view('public/Cart/carttable');
	}
	/*
	* Function to add item in the cart
	*/
	public function addtocart() {

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

			$promotionCode = $this->session->userdata('PromotionCode');
			if(!empty($promotionCode)){
			$cart = $this->cart->contents();
			$response = $this->Products_Model->GetDiscountedPrice($promotionCode,$cart);
				if(!empty($response)){
					$this->session->set_userdata('discount_data', $response);
				}
			}	
			redirect('/checkout/index');
		}
	}
	/*
	* Function to delete item from the cart
	*/
	public function delete() {

		$rowid = $_GET['rowid'];
		$data = array('rowid' => $rowid,'qty' => 0);
		$this->cart->update($data);
		$this->session->unset_userdata('PromotionStatus');
		$this->session->unset_userdata('discountamount');
		$this->session->unset_userdata('PromotionCode');

		redirect('/checkout/index');
	}
	/*
	* Function to update item in the cart
	*/
	public function UpdateCartRow() {
		
		$row = $this->input->post('row');
		$quantity = $this->input->post('quantity');
		$data = array('rowid' => $row, 'qty' => $quantity);
		$this->cart->update($data);

		echo 1;
	}
	/*
	* Function to apply promotion code and get discounted pricce by AJAX
	*/
	public function update() {

		$data  = $_POST;
		foreach ($data as $key => $value) {
			if(!empty($value['rowid'])){
				$rowid = $value['rowid'];
				$qty = $value['qty'];
				if(!empty($rowid)){
					$data = array('rowid' => $rowid,'qty' => $qty);
					$this->cart->update($data);
				}
			}
		}
		$promotionCode = $this->session->userdata('PromotionCode');
		if(!empty($promotionCode)){
			$cart = $this->cart->contents();
			$response = $this->Products_Model->GetDiscountedPrice($promotionCode,$cart);
			if(!empty($response)){
				$this->session->set_userdata('discount_data', $response);
			}
		}	

		redirect('/checkout/index');
	}
		/*
	* Function to view the checkout page
	*/
	public function checkout() {
		$personID = $this->session->userdata('person_id');
		if(isset($personID)){
			$this->data['active'] = "Checkout";
			$this->data['userInfo'] =  $this->User_Model->GetAllUserDetailsByID($personID);
			$this->data['authprofileID'] = $this->User_Model->checkAuthProfileID($personID);
			$ccnumberdigit= $this->User_Model->lastfourdigit($personID);
			$this->data['cardfourdigit'] =substr($ccnumberdigit, -4); 
			$this->data['countries'] = $this->getCountryName();
			$this->data['subview'] = "public/Cart/billingQoutation";
			$this->load->view('public/_layout_main',$this->data);
		}else{
			$fromCart = $this->input->get('fromCart');
			redirect('/user/login?fromcart='.$fromCart);
		}	
	}
		/*
	* Function to view the guest chcekout page
	*/
	public function guestcheckout() {

		$this->data['active'] = "Guest Checkout";
		$this->data['countries'] = $this->getCountryName();
		$this->data['subview'] = "public/Cart/billingQoutation";
		$this->load->view('public/_layout_main',$this->data);
	}
	/*
	* Function to calculate tax rate on the bases of information provided
	*/
	public function getTaxRate($zipCode = null, $state = null, $taxExempt = null) {

		$Alameda_zip_arr = array("94501", "94502", "94536", "94538", "94539", "94541", "94542", "94544", "94545", "94546", "94550", "94551", "94552", "94555", "94560", "94566", "94568", "94577", "94578", "94579", "94580", "94586", "94587", "94588", "94601", "94602", "94603", "94605", "94606", "94607", "94608", "94609", "94610", "94611", "94612", "94615", "94617", "94618", "94619", "94621", "94702", "94703", "94704", "94705", "94706", "94707", "94708", "94709", "94710");

		if (in_array($zipCode, $Alameda_zip_arr) && empty($taxExempt)) {			
			$taxrate =  0.0975;	  
		}else {
			if (strtoupper($state)=="CA" || strtoupper($state)=="CALIFORNIA") {
				$taxrate = !empty($taxExempt) ? 0 : 0.0725;	   
			}else{
				$taxrate =  0;
			}					   
		}
		return $taxrate;
	}
	/*
	* Function to calculate the discount from the discount Array
	*/
	public function getDiscountAmount($discountArray = null, $cart = []) {

		$discountamount = 0;
		if(is_array($discountArray) && !empty($discountArray) && !empty($cart)){
			foreach ($discountArray  as $d) {
				$status = $d['Status'];
				if($status == 'true'){
					$codedate = $d['Data'][0]->expirydate;
					if(empty($codedate)){
						$codedate = date('Y-m-d',time());
					}
					$expd = strtotime($codedate);
					$dtoday = time();
					if( $dtoday < $expd ){
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

		return $discountamount;
	}
	/*
	* Function to get the billing qoutation page and setting the session data
	*/
	public function billingQuotationProcess() {
  
		if($this->input->post() || $_SESSION['PreviousInfo']) {
			$personID = $this->session->userdata('person_id');
			$PostData = $this->input->post();
			$cart=$this->cart->contents();
			if($PostData){
				$fedex_acct_num = $this->input->post('fedex_accnt');
				$fedex_service =$this->input->post('fedex_service');
				$taxExemptId = $this->input->post('sales_tax_exempt_num1');
				$taxrate = $this->getTaxRate($this->input->post('szip'), $this->input->post('sstate'), $taxExemptId);
				$this->session->set_userdata('PreviousInfo',$PostData);
			}
			if($_SESSION['PreviousInfo']){
				$PreviousInfo = $_SESSION['PreviousInfo'];
				$fedex_acct_num = $PreviousInfo['fedex_accnt'];
				$fedex_service =$PreviousInfo['fedex_service'];
				$taxExemptId = $PreviousInfo['sales_tax_exempt_num1'];
				$taxrate = $this->getTaxRate($PreviousInfo['szip'], $PreviousInfo['sstate'], $taxExemptId);
			}
			
			$discountamount = $this->getDiscountAmount($this->session->userdata('discount_data'), $this->cart->contents());
			
			$shippingFee = !empty($fedex_acct_num) ? 0 : (float)$this->get_shipping_fee($fedex_acct_num, $fedex_service, $cart);

			if($discountamount !== 0){
				$newTaxTotal = $taxrate*($this->cart->total()-$discountamount);
				$tax =(float)$newTaxTotal;
				$total = $this->cart->total() + $tax + $shippingFee - $discountamount;
			}else{
				$tax =(float)$taxrate*$this->cart->total();
				$total = $this->cart->total() + $tax + $shippingFee;				
			}
			if($this->input->post('payment_type')=="Credit Card"){
				$extraInfo = array(
					'taxExempt' => $taxExemptId,
					'tax' => $tax,
					'shippingFee' => $shippingFee
				);
				$this->data['authToken'] = self::generateAuthorizeToken($total, $this->cart->contents(), $extraInfo);
			}

			$this->session->set_userdata('discountamount',$discountamount);

			
			$this->data['tax'] = $tax;
			$this->data['total'] = $total;
			$this->data['active'] = isset($personID) ? "Checkout" : "Guest Checkout";
			$this->data['captcha_site_key']=$this->data['capcha_site_id'];
			$this->data['shippingFee'] = $shippingFee;
			$this->data['countries'] = $this->getCountryName();
			if(isset($personID)){
				$this->data['userInfo'] =  $this->User_Model->GetAllUserDetailsByID($personID);
			}
			$this->data['hostedAccessPaymentPage'] = $this->load->view('public/Modals/hostedAccessPaymentPage', NULL, TRUE);
			// $this->data['paypalHostedAccessPaymentPage'] = $this->load->view('public/Modals/paypalHostedAcceptPaymentPage', NULL, TRUE);
			$this->data['subview'] = "public/Cart/billingQoutationProcess";
			$this->load->view('public/_layout_main',$this->data);	
		}
	}
	/*
	* Function to calculate shipping fee on the bases of fedex account number and service
	*/
	public function get_shipping_fee($fedex_acct_num, $fedex_service, $cart) {

		$shipping_fee = 0; $base_ice = 38.90; $base_RT = 18.90;
		if ($fedex_service == '2nd Day Air') {
			$base_ice = 38.90; $base_RT = 18.90;
		} else if ($fedex_service == 'Standard Overnight') {
			$base_ice = 60.90; $base_RT = 40.90;
		} else if ($fedex_service == 'Priority Overnight') {
			$base_ice = 90.90; $base_RT = 50.90;
		}		
		$cnt_ice_prod = 0; $cnt_RT_prod = 0;

		foreach($cart as $prodid => $product) {
			$qty=$product['qty'];
			$mmshipping_method=$product['shippingmt'];
			if ($mmshipping_method == 'On Ice') {
				$cnt_ice_prod += $qty;
			} else if ($mmshipping_method == 'RT') {
				$cnt_RT_prod += $qty;
			}
		}
		if ( preg_match("/^[0-9]{9}$/", $fedex_acct_num) ) {
			if ($cnt_ice_prod > 0) {
				$shipping_fee += 20;
			}
			if ($cnt_RT_prod > 0) {
				$shipping_fee += 6;
			}
			return $shipping_fee;
		}else {
			if ($cnt_ice_prod > 0) {
				$shipping_fee += $base_ice + $cnt_ice_prod * 6;
			}
			if ($cnt_RT_prod > 0) {
				$shipping_fee += $base_RT + $cnt_RT_prod * 6;
			}

			return $shipping_fee;
		}
	}
	/*
	* Function to get the discount
	*/
	public function getDiscount() {

		$discountPost=$this->input->post('discountcod');
		$cart = $this->cart->contents();
		if(!empty($discountPost)) {
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
	/*
	* Function to remove discount code
	*/
	public function removeDiscountCode(){

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
		/*
	* Function to process final transaction of the items contains paypal authorize and purchase orders
	*/
	public function finalTransaction() {
		if(!isset($_SESSION['PreviousInfo'])){
			redirect('/checkout/checkout?fromCart=true');
		}
		$postData = $this->input->post();
		$sessionData = $this->session->userdata;
		$cart = $this->cart->contents();
		$discountamount = $this->session->userdata('discountamount');
		$finalprice = $this->cart->format_number($this->cart->total());
		if(!empty($discountamount)){
			$finalprice -= $discountamount;
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
				'po_num' => $this->input->post('po_num'),
				'ordering_method'=>'web',
				'payment_method'=>$this->input->post('payment_type'),
				'orders_status'=>'processing',
				'billing_name'=>$this->input->post('battn'),
				'billing_co_name'=>$this->input->post('bcompany'),
				'billing_address_1'=>$this->input->post('baddr1'),
				'billing_address_2'=>$this->input->post('baddr2'),
				'billing_city'=>$this->input->post('bcity'),
				'billing_state'=>$this->input->post('bstate'),
				'billing_zip'=>$this->input->post('bzip'),
				'billing_country'=>$this->input->post('bcountry'),
				'billing_tel'=>$this->input->post('bphone'),
				'billing_fax'=>$this->input->post('bfax'),
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
				'fedex_number' => $this->input->post('fedex_accnt'),
				'fedex_delivery' => $this->input->post('fedex_service'),
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
					if(!empty($value)) {
						$opLinkData = array(
							'orders_id'=>$orderID,
							'product_id'=>$value['id'],
							'mod_date'=>date('Y-m-d',time())
						);
						$this->OPLink_Model->Save(null,$opLinkData);
						$this->setAndSaveOrderDetails($orderID, $value['id'], $value['price']*$value['qty']);
					}
				}
				$shippingfee =  !empty($fedex_acct_num) ? 0 : $this->get_shipping_fee($fedex_acct_num, $fedex_service, $cart);
				$taxrate = $this->getTaxRate($this->input->post('szip'), $this->input->post('sstate'), $this->input->post('tax_exempt_id'));
				$newTotal = $this->cart->total()+($this->cart->total() * $taxrate)+$shippingfee;
				$newTotal = number_format((float)$newTotal, 2, '.', '');

				$this->session->set_userdata('newTotal', $newTotal);
				$this->session->set_userdata('taxrate', $taxrate);
				$this->session->set_userdata('shippingfee', $shippingfee);

				$this->setAndSaveOrderDetails($orderID, 'subtotal', $this->cart->format_number($this->cart->total()));
				$this->setAndSaveOrderDetails($orderID, 'shippingfee', $shippingfee);
				$this->setAndSaveOrderDetails($orderID, 'tax', $taxrate);
				$this->setAndSaveOrderDetails($orderID, 'total', $newTotal);

				$country = $this->input->post('scountry');
                
				if($country!="United States"){
					$dataArray = array(
						'orderId' => $orderID, 'cart' => $cart, 'type' => null, 'finalPrice' => $finalprice, 'shippingfee' => $shippingfee, 'taxRate' => null, 'newTotal' => null
					);  
					$this->getPurchaseOrderCheckout($dataArray, $this->input->post(), true);
				}
				if($this->input->post('payment_type')=="Purchase Order"){
					$dataArray = array(
						'orderId' => $orderID, 'cart' => $cart, 'type' => 'Purchase Order', 'finalPrice' => $finalprice, 'shippingfee' => $shippingfee, 'taxRate' => $taxrate, 'newTotal' => $newTotal
					);  
					$this->getPurchaseOrderCheckout($dataArray, $this->input->post(), false);
				}
				if($this->input->post('payment_type')=="Paypal"){
					$this->getPaypalCheckout($orderID, $this->input->post());	
				}
				if($this->input->post('payment_type')=="Credit Card"){
					
					$postData['shippingFee'] = $shippingfee;
					$this->session->set_userdata('postArray', $postData);
					$response  = $this->generateAuthorizeToken($finalprice, $cart, $postData);
					echo json_encode(['order_id'=> $orderID, 'token'=>$response],JSON_UNESCAPED_SLASHES);
					die;
				}
			}
		}
	}
	/*
	* Save the data in order details and return type void
	*/
	public function setAndSaveOrderDetails($orderId=null, $tag = null, $value = null) {
		$data = array(
			'orders_id'=>$orderId,
			'tag'=>$tag,
			'value'=>$value,
			'mod_date'=>date('Y-m-d',time())
		);
		$this->OrderDetails_Model->Save(null,$data);
	}

	/*
	* Function to set Purchase order request
	*/
	public function getPurchaseOrderCheckout($dataArray = [], $postArray = [], $checkUS=false) {

		$updateArray = array('payment_method'=>isset($checkUS) && $checkUS==true ? "Quotation" : "PO");
		$purchaseOrderDetails = array('orders_id'=>$dataArray['orderId'],'tag'=>'po_num','value'=>$postArray['po_num'],'mod_date'=>date('Y-m-d',time()));

		$this->Order_Model->Save($dataArray['orderId'],$updateArray);
		$this->OrderDetails_Model->Save(null,$purchaseOrderDetails);

		$email = $this->getEmailReceivers($postArray['semail']);
		$emailtitle = $this->getEmailTitle();
		$emailbody = $this->getEmailBody($dataArray, $postArray);
		$header = $this->getEmailHeader();
		mail($email,$emailtitle,$emailbody, $header);

		$this->getThanksResponse($postArray['semail']);
	}
	/*
	* Function to set thanks message and retrive thanks page
	*/
	public function getThanksResponse($email = null) {
		$responseText = "<span class=\"textbold\">An email has been sent to ".$email."</span><br><br><br >";
		$response = array('Response'=>0,'Message'=>$responseText);
		$this->session->set_flashdata('response',$response);

		$this->cart->destroy();
		redirect('/checkout/thanks');
	}
	/*
	* Function to set paypal Payment Gateway
	*/
	public function getPaypalCheckout($orderId=null, $data = []) {
		
		$countryCode = $this->returnCountryCode($data['scountry']);	
		$this->session->set_userdata('orderID', $orderId);
		$this->session->set_userdata('SHIPTONAME', $data['sattn']);
		$this->session->set_userdata('SHIPTOSTREET', $data['saddr1'].', '.$data['saddr2']);
		$this->session->set_userdata('SHIPTOCITY', $data['scity']);
		$this->session->set_userdata('SHIPTOSTATE', $data['sstate']);
		$this->session->set_userdata('SHIPTOCOUNTRY', $countryCode);
		$this->session->set_userdata('SHIPTOZIP', $data['szip']);
		$this->session->set_userdata('SHIPTOPHONENUM', $data['sphone']);
		$this->session->set_userdata('po_num', $data['po_num']);
		$this->session->set_userdata('fedex_account_number', $data['fedex_accnt']);
		$this->session->set_userdata('payEmail', $data['semail']);
		$this->session->set_userdata('taxExemptId', $data['tax_exempt_id']);

		
		redirect('express_checkout/SetExpressCheckout');
	}

	/*
	* Function to set Hosted Access Payment Pages
	*/
	public function getAuthorizeResponse() {
		$orderID = $this->input->post('order');
		if(isset($orderID) && !empty($orderID)) {
			$dataArray = array(
				'orderId' => $orderID,
				'cart' => $this->cart->contents(),
				'type' => 'Credit Card',
				'finalPrice' => $this->Transaction_Model->getPricebyOrderId($orderID),
				'shippingfee' => $this->Order_Model->getOrderExtraDetails($orderID,'tag','shippingfee'),
				'taxRate' => $this->Order_Model->getOrderExtraDetails($orderID,'tag','tax'),
				'newTotal' => $this->Order_Model->getOrderExtraDetails($orderID,'tag','total')
			);  
			$updateArray = array('payment_method'=> "CC" ,'orders_status' => 'completed');
			$this->Order_Model->Save($dataArray['orderId'],$updateArray);
			
			if($this->session->has_userdata('postArray')){
			   	$postArray = $this->session->userdata('postArray');
				$email = $this->getEmailReceivers($postArray['semail']);
				$emailtitle = $this->getEmailTitle();
				$emailbody = $this->getEmailBody($dataArray, $postArray);
				$header = $this->getEmailHeader();
				mail($email,$emailtitle,$emailbody, $header);
				$this->session->unset_userdata('postArray');	
			}
			echo json_encode(true);
		}else {
			echo json_encode(false);
		}
		
	}
	/*
	* Function to generate authorize token
	*/
	public function generateAuthorizeToken($amount=0, $items, $extraInfo = []) {

		$token = $this->Authentication_Model->getAnAcceptPaymentPage($amount, $items, $extraInfo);
		
		return $token;
	}
	/*
	* Function to get Email Headers
	*/
	public function getEmailHeader() {

		$salesemail = "order@bioassaysys.com";
		$header = "From: ".$salesemail."\r\n"; 
		$header.= "MIME-Version: 1.0\r\n"; 
		$header.= "Content-type: text/html; charset=utf-8\r\n";

		return $header;
	}
	/*
	* Function to get Email receivers
	*/
	public function getEmailReceivers($email = null) {
		$email = $email."," ;
		$email .="order@bioassaysys.com";

		return $email;
	}
	/*
	* Function to set and get Email Title
	*/
	public function getEmailTitle() {

		$emailtitle = "Order receipt - www.bioassaysys.com";

		return $emailtitle;
	}
	/*
	* Function to get email body 2
	*/
	public function getEmailBodyTwo($orderID = null, $type=null) {

		if(isset($type)) {
			$emailbody="Your order #".$orderID." has been placed, please keep a record of this receipt.<br ><br >Payment Method: $type<br><br>";
		}else {
			$emailbody = "This is to confirm that we have received your quotation request #".$orderID.".  BioAssay Systems will email a detailed quote for your order including shipping/handling fee within 24 hours.<br ><br >";
		}
		return $emailbody;
	}
	/*
	* Function to get full final email body
	*/
	public function getEmailBody($emailArray = [], $body = null) {
		$emailbody1 = "Dear ".$body['sattn'].",<br ><br >";
		$emailbody2 = $this->getEmailBodyTwo($emailArray['orderId'], $emailArray['type']);
		$emailbody3 = isset($emailArray['type']) ? 'Order Details:<br ><br >' : 'Quotation Request Details:<br ><br >';	
		$emailbody3.= isset($body['po_num']) && !empty($body['po_num']) ? "PO Number: ".$body['po_num']."<br ><br >" :'';
		foreach($emailArray['cart'] as $prodid => $product) {
			if($product != null) {
				$shipping_method= $product['shippingmt'];
				$emailbody3.="Product Name:".$product['name']."<br >Catalog No: ".$product['catalog']."<br >Shipping method: ".$product['shippingmt']."<br >Price: $". $product['price']."<br >QTY: ".$product['qty']." <br ><br >";
			}
			$emailbody3.='<br>';
		}
		if(!empty($body['discount'])){
			$discountamount = $this->session->userdata('discountamount');	
			$emailbody3.="Discount Code: ".$body['discount']." <br > Discount Price: $".$discountamount."<br>";
			if(isset($emailArray['type'])) { 
				$emailArray['newTotal'] = $emailArray['newTotal']-$discountamount;
			}
		}
		$emailbody3.="Subtotal: $".$emailArray['finalPrice']."<br >";
		$emailbody3.=isset($emailArray['type']) ? "S/H: $".number_format($emailArray['shippingfee'],2)."<br >" : "S/H: TBD<br >";	 
		$emailbody3.= !empty($body['tax_exempt_id']) ? "Tax Exempt Number: ".$body['tax_exempt_id']."<br/>": '';
		if(isset($emailArray['type'])) { 
			$emailbody3.="Tax: $".number_format($emailArray['taxRate']*($this->cart->total()),2)."<br >";
			$emailbody3.="Total: $".$emailArray['newTotal']."<br ><br >";
		}else {
			$emailbody3.="Total: TBD<br ><br >";
		}

		if($shipping_method == "USPS") {
			$emailbody3.= $body['scountry']=='United States' || $body['scountry'] == 'US' ? 'Free 2-5 Day USPS Shipping<br ><br >' : 'International Shipping<br ><br >';
		} else {
			if ($body['fedex_accnt']) {
				if ( preg_match("/^[0-9]{9}$/",$body['fedex_accnt']) ) {
					$emailbody3.="FedEx Acct #: ".$body['fedex_accnt']."<br >";
				} else {
					$emailbody3.="FedEx Acct #: ".$body['fedex_accnt']." Invalid, not counted for S&H fee calculation.<br >";
				}
			}
			$emailbody3.= ($body['scountry']=='United States') || $body['scountry'] == 'US' ? "FedEx Delivery: ".$body['fedex_service']."<br ><br >" : "International Shipping <br><br>";
		}

		$billingAddress = $this->setBillingAddress($body);
		$shippingAddress = $this->setShippingAddress($body);
		$emailbody3.=$shippingAddress.$billingAddress;
		$emailbody3.="Notes:<br >".$body['cmnts']."<br ><br >";
		$emailbody3.="We thank you for your business!<br ><br >Your BioAssay Systems Team<br >";
		$emailbody=$emailbody1.$emailbody2.$emailbody3;
		return $emailbody;
	}
	/*
	* Function to destroy cart 
	*/
	public function setBillingAddress($body=[]) {
		$billingAddress="Bill to:<br >".$body['battn']."<br >";
		$billingAddress.=$body['bcompany']."<br >";
		$billingAddress.=$body['baddr1']."<br >";
		$billingAddress.=isset($body['baddr2']) ? $body['baddr2']."<br >" : '';
		$billingAddress.=$body['bcity'].", ";
		$billingAddress.=$body['bstate']." ";
		$billingAddress.=$body['bzip']."<br >";
		$billingAddress.=$body['bcountry']."<br >";
		$billingAddress.=$body['bphone']." (tel)<br >";
		$billingAddress.=$body['bfax']." (fax)<br ><br >";

		return $billingAddress;
	}
	/*
	* Function to destroy cart 
	*/
	public function setShippingAddress($body = []) {
		
		$shippingAddress="Ship to:<br >".$body['sattn']."<br >";
		$shippingAddress.=$body['scompany']."<br >";
		$shippingAddress.=$body['saddr1']."<br >";
		$shippingAddress.=isset($body['saddr2']) ? $body['saddr2']."<br >" : '';
		$shippingAddress.=$body['scity'].", ";
		$shippingAddress.=$body['sstate']." ";
		$shippingAddress.=$body['szip']."<br >";
		$shippingAddress.=$body['scountry']."<br >";
		$shippingAddress.=$body['sphone']." (tel)<br >";
		$shippingAddress.=$body['semail']."<br ><br >";
		
		return $shippingAddress;
	}
	/*
	* Function to destroy cart 
	*/
	public function destroycart() {

		$this->cart->destroy();
		$this->session->unset_userdata('discountamount');
		$url = base_url();
		
		redirect($url);
	}
	/*
	* Function to load failed view if order not processed or any critical error
	*/
	public function failed() {

		$this->data['active'] = "Cart";
		$this->data['subview'] = "public/Cart/failed";
		$this->load->view('public/_layout_main',$this->data);
	}
	/*
	* Function to show thanks page on successful placinf the order
	*/
	public function thanks() {

		$this->cart->destroy();
		$this->data['active'] = "Cart";
		$this->data['subview'] = "public/Cart/thanks";
		$this->load->view('public/_layout_main',$this->data);
	}
	/*
	* Function to get authorization token for the hosted access payment pages
	*/
	public function GetAuthToken(){
		$tax = $_GET['taxExempt'] == 0 ? $_GET['tax'] : 0;
		$extraInfo = array(
			'taxExempt' => $_GET['taxExempt'] ? $_GET['taxExempt'] :null,
			'tax' => $tax ? $tax : 0,
			'shippingFee' => $_GET['shipping'] ? $_GET['shipping'] : 0,
			'fedex' => $_GET['fedex'] ? $_GET['fedex'] : null,
			'delivery' => $_GET['delivery'] ? $_GET['delivery'] : null
		);
		$totalAmount = $this->cart->total() + $extraInfo['shippingFee'] + $extraInfo['tax'];
		if(isset($_SESSION['PromotionCode']) && isset($_SESSION['discountamount'])) {
			$extraInfo['discountCode'] = $_SESSION['PromotionCode'];
			$extraInfo['discountAmount'] = $_SESSION['discountamount'];
			$totalAmount = $totalAmount - $_SESSION['discountamount'];
		}
		$this->data['authToken'] = self::generateAuthorizeToken($totalAmount, $this->cart->contents(), $extraInfo);
		$data = array('AuthToken'=>$this->data['authToken'],'Url'=>'https://test.authorize.net/payment/payment');

		echo json_encode($data,JSON_UNESCAPED_SLASHES);
	}
	/*
	* Function to create iframe communicator for communication between authorize and our platform
	*/
	public function iFrameCommunicator() {

		$this->load->view('public/Cart/iframeCommunicator');
	}
	/*
	* Function to return the country code on the bases of country's name post
	*/
	public function returnCountryCode($countryNamePost){
		$countryname = $this->getCountryName();
		$countryvalue=array("US","AL","DZ","AS","AO","AI","AG","AR","AM","AW","AU","AT","AZ","BS","BH","BD","BB","BY","BE","BZ","BJ","BM","BT",
		"BO","BL","BA","BW","BR","VG","BN","BG","BF","BI","KH","CM","CA","CV","KY","TD","CL","CN","CO","CG","CK","CR","HR","CB","CY","CZ","DK",
		"DJ","DM","DO","EC","EG","SV","EE","ET","FJ","FI","FR","GF","PF","GA","GM","GE","DE","GH","GI","GR","GD","GP","GU","GT","GN","GW","GY",
		"HT","HN","HK","HU","IS","IN","ID","IE","IL","IT","CI","JM","JP","JO","KZ","KE","KI","XK","XE","KW","KG","LA","LV","LB","LS","LT","LU","MK","MG",
		"MW","MY","MV","ML","MT","MH","MQ","MR","MU","MX","MD","MN","MS","MA","MZ","NP","NL","NC","NZ","NI","NE","NG","MP","NO","OM","PK",
		"PW","PA","PG","PY","PE","PH","PL","XP","PT","PR","QA","RE","RO","XC","RU","RW","XS","SA","SN","CS","SC","SG","SK","SI","SB","ZA","KR",
		"ES","LK","NT","VI","EU","VI","KN","LC","MB","VI","VC","SR","SZ","SE","CH","SY","TJ","TW","TZ","TH","XN","TG","TO","VG","TT","XA","TN",
		"TR","TM","TC","TV","UG","UA","VC","AE","GB","UY","VI","UZ","VU","VE","VN","VG","WF","WS","XY","YE","ZM","ZW");

		
		$newCountryArray = array();	
		for($i=0;$i<sizeof($countryname); $i++){
			$newCountryArray[$countryvalue[$i]] = $countryname[$i];
		}

		return(array_search($countryNamePost, $newCountryArray));
	}
	/*
	* Function to return the country name array
	*/
	public function getCountryName() {
		return array("United States","Albania","Algeria","American Samoa",
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
	}
/*
* Get Authorization token for paypal
*/

	public function getPaypalIframe() {
		
		$cart = $this->cart->contents();
		$response = $this->PaypalPayflow->runPayflow($cart);
		echo json_encode($response);
	}

	public function getPaypalResponse() {
		if (isset($_POST['RESULT']) || isset($_GET['RESULT']) ) {
			$_SESSION['payflowresponse'] = array_merge($_GET, $_POST);
			$data = array('transaction_id' => $_SESSION['payflowresponse']['PNREF'], 'order_items' => json_encode($this->cart->contents()));
			$this->PaypalPayflow->save(null, $data);
			echo '<script type="text/javascript">window.top.location.href = "' . base_url('checkout/thanks') .  '";</script>';
			exit(0);
		}
	}
	
}