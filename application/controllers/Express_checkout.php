<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Express_checkout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load helpers
		$this->load->helper('url');
		$this->load->model('Member/Order_Model');
		$this->load->model('Member/Paypal_transaction');
		// Load session library
		$this->load->library('session');

		// Load PayPal library config
		$this->config->load('paypal');

		$config = array(
			'Sandbox' => $this->config->item('Sandbox'),            // Sandbox / testing mode option.
			'APIUsername' => $this->config->item('APIUsername'),    // PayPal API username of the API caller
			'APIPassword' => $this->config->item('APIPassword'),    // PayPal API password of the API caller
			'APISignature' => $this->config->item('APISignature'),    // PayPal API signature of the API caller
			'APISubject' => '',                                    // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion'),        // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			'DeviceID' => $this->config->item('DeviceID'),
			'ApplicationID' => $this->config->item('ApplicationID'),
			'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
		);

		// Show Errors
		if ($config['Sandbox']) {
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}

		// Load PayPal library
		$this->load->library('paypal/paypal_pro', $config);
	}

	/**
	 * Cart Review page
	 */
	function index()
	{
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');

		// Clear cart from session userdata
		$this->session->unset_userdata('shopping_cart');

		// For demo purpose, we create example shopping cart data for display on sample cart review pages

		// Example Data - cart item
		// $cart['items'][0] = array(
		// 	'id' => '123-ABC',
		// 	'name' => 'Widget',
		// 	'qty' => '2',
		// 	'price' => '9.99',
		// );

		// // Example Data - cart item
		// $cart['items'][1] = array(
		// 	'id' => 'XYZ-456',
		// 	'name' => 'Gadget',
		// 	'qty' => '1',
		// 	'price' => '4.99',
		// );

		// Example Data - cart variable with items included
		$cart['shopping_cart'] = $this->cart->contents();

		// Example Data - grand total
		$discountamount = $this->session->userdata('discountamount');
		if(!empty($discountamount)){
			$cart['shopping_cart']['grand_total'] = $this->cart->format_number($this->cart->total()) - $discountamount ;
		}else{
			$cart['shopping_cart']['grand_total'] = $this->cart->format_number($this->cart->total());
		}
		

		// Load example cart data to variable
		$this->load->vars('cart', $cart);

		// Set example cart data into session
		$this->session->set_userdata('shopping_cart', $cart);

		// Example - Load Review Page
		$this->load->view('paypal/demos/express_checkout/index', $cart);
	}

	/**
	 * SetExpressCheckout
	 */
	function SetExpressCheckout()
	{
		$this->session->unset_userdata('PayPalResult');

		// Clear cart from session userdata
		$this->session->unset_userdata('shopping_cart');

		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');

		// Get cart data from session userdata
		$cart =$this->cart->contents();
		$taxrate = $this->session->userdata('taxrate');
		$shippingfee = $this->session->userdata('shippingfee');
		$discountamount = $this->session->userdata('discountamount');
		if(!empty($discountamount)){
			$TotalAmount =$this->cart->total()+$shippingfee+($taxrate*$this->cart->total()) - $discountamount ;
		}else{
			$TotalAmount =$this->cart->total()+$shippingfee+($taxrate*$this->cart->total());
		}
		
		
		/**
		 * Here we are setting up the parameters for a basic Express Checkout flow.
		 *
		 * The template provided at /vendor/angelleye/paypal-php-library/templates/SetExpressCheckout.php
		 * contains a lot more parameters that we aren't using here, so I've removed them to keep this clean.
		 *
		 * $domain used here is set in the config file.
		 */
		$SECFields = array(
			'maxamt' => $this->cart->format_number($TotalAmount),			// The expected maximum total amount the order will be, including S&H and sales tax.
			'returnurl' => site_url('/express_checkout/GetExpressCheckoutDetails'), 							    // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
			'cancelurl' => site_url('/express_checkout/OrderCancelled'), 							    // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
			'hdrimg' => 'https://www.bioassaysys.com/images/logo.png', 			// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
			'logoimg' => 'https://www.bioassaysys.com/images/logo.png', 					// A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
			'brandname' => 'Bioassay Systems', 							                                // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
			'customerservicenumber' => '510-782-9988', 	 // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
			'ADDROVERRIDE'=>0,			                               
		);

		/**
		 * Now we begin setting up our payment(s).
		 *
		 * Express Checkout includes the ability to setup parallel payments,
		 * so we have to populate our $Payments array here accordingly.
		 *
		 * For this sample (and in most use cases) we only need a single payment,
		 * but we still have to populate $Payments with a single $Payment array.
		 *
		 * Once again, the template file includes a lot more available parameters,
		 * but for this basic sample we've removed everything that we're not using,
		 * so all we have is an amount.
		 */
		// $_SESSION['SHIPTOPHONENUM']
		$Payments = array();
		
		$Payment = array(
			'amt' => $this->cart->format_number($TotalAmount), 	// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
			'SHIPTONAME' => $this->session->userdata('SHIPTONAME'),
			'SHIPTOSTREET' => $this->session->userdata('SHIPTOSTREET'),
			'SHIPTOCITY' => $this->session->userdata('SHIPTOCITY'),
			'SHIPTOSTATE' => $this->session->userdata('SHIPTOSTATE'),
			'SHIPTOCOUNTRY' => $this->session->userdata('SHIPTOCOUNTRY'),
			'SHIPTOZIP' => $this->session->userdata('SHIPTOZIP'),
			'SHIPTOPHONENUM' => $this->session->userdata('SHIPTOPHONENUM')
		);
		unset($_SESSION['SHIPTONAME']);
		unset($_SESSION['SHIPTOSTREET']);
		unset($_SESSION['SHIPTOCITY']);
		unset($_SESSION['SHIPTOSTATE']);
		unset($_SESSION['SHIPTOZIP']);
		unset($_SESSION['SHIPTOCOUNTRY']);
		unset($_SESSION['SHIPTOPHONENUM']);

		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'SECFields' => $SECFields,
			'Payments' => $Payments,
		);
		
		/**
		 * Here we are making the call to the SetExpressCheckout function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */

		$PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
		// echo "<pre>";
		// // print_r($PayPalRequestData);
		// print_r($PayPalResult);
		// echo "</pre>";
		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If all goes well, we save our token in a session variable so that it's
		 * readily available for us later, and then redirect the user to PayPal
		 * using the REDIRECTURL returned by the SetExpressCheckout() function.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->load->view('paypal/demos/express_checkout/paypal_error');
		}
		else
		{
			// Successful call.

			// Set PayPalResult into session userdata (so we can grab data from it later on a 'payment complete' page)
			$this->session->set_userdata('PayPalResult', $PayPalResult);

			// In most cases you would automatically redirect to the returned 'RedirectURL' by using: redirect($PayPalResult['REDIRECTURL'],'Location');
			// Move to PayPal checkout
			redirect($PayPalResult['REDIRECTURL'], 'Location');
		}
	}

	/**
	 * GetExpressCheckoutDetails
	 */
	function GetExpressCheckoutDetails()
	{
		$cart = $this->cart->contents();
		$taxrate = $this->session->userdata('taxrate');
		$shippingfee = $this->session->userdata('shippingfee');
		$discountamount = $this->session->userdata('discountamount');
		if(!empty($discountamount)){
			$TotalAmount =$this->cart->total()+$shippingfee+($taxrate*$this->cart->total()) - $discountamount ;
		}else{
			$TotalAmount =$this->cart->total()+$shippingfee+($taxrate*$this->cart->total());
		}

		
		// Get PayPal data from session userdata
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		/**
		 * Now we pass the PayPal token that we saved to a session variable
		 * in the SetExpressCheckout.php file into the GetExpressCheckoutDetails
		 * request.
		 */
		$PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If the call is successful, we'll save some data we might want to use
		 * later into session variables.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->load->view('paypal/demos/express_checkout/paypal_error');
		}
		else
		{
			// Successful call.

			/**
			 * Here we'll pull out data from the PayPal response.
			 * Refer to the PayPal API Reference for all of the variables available
			 * in $PayPalResult['variablename']
			 *
			 * https://developer.paypal.com/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
			 *
			 * Again, Express Checkout allows for parallel payments, so what we're doing here
			 * is usually the library to parse out the individual payments using the GetPayments()
			 * method so that we can easily access the data.
			 *
			 * We only have a single payment here, which will be the case with most checkouts,
			 * but we will still loop through the $Payments array returned by the library
			 * to grab our data accordingly.
			 */
			$cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
			$cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
			$cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
			$cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

			foreach($PayPalResult['PAYMENTS'] as $payment) {
				$cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
				$cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
				$cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
				$cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
				$cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
				$cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
				$cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
				$cart['phone_number'] = isset($payment['SHIPTOPHONENUM']) ? $payment['SHIPTOPHONENUM'] : '';
			}

			/**
			 * At this point, we now have the buyer's shipping address available in our app.
			 * We could now run the data through a shipping calculator to retrieve rate
			 * information for this particular order.
			 *
			 * This would also be the time to calculate any sales tax you may need to
			 * add to the order, as well as handling fees.
			 *
			 * We're going to set static values for these things in our static
			 * shopping cart, and then re-calculate our grand total.
			 */
			$cart['shopping_cart']['shipping'] = $shippingfee;
			$cart['shopping_cart']['handling'] = 0.00;
			$cart['shopping_cart']['tax'] = ($this->cart->total()*$taxrate);
			


			$cart['shopping_cart']['grand_total'] = number_format($TotalAmount,2);
			//need to add tax shipping and handling fee


			/**
			 * Now we will redirect the user to a final review
			 * page so they can see the shipping/handling/tax
			 * that has been added to the order.
			 */
			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Load example cart data to variable
			$this->load->vars('cart', $cart);

			// Example - Load Review Page
			// $this->load->view('paypal/demos/express_checkout/review', $cart);
			$this->data['active'] = "Products";
			$this->data['cart'] = $cart;
			$this->data['subview'] = "paypal/demos/express_checkout/review";
			$this->load->view('public/_layout_main',$this->data);
		}
	}

	function setCheckoutItems($cart) {
		$itemsArray = array();
		foreach($cart as $item) {
			$Item = array(
				'name' => $item['name'], 								// Item name. 127 char max.
				'desc' => $item['catalog'], 								// Item description. 127 char max.
				'amt' => $item['price'],							// Item number.  127 char max.
				'number' => $item['id'],
				'qty' => $item['qty'], 								// Item qty on order.  Any positive integer.
				);
			array_push($itemsArray, $Item);
		}
		if(isset($_SESSION['PromotionCode']) && isset($_SESSION['discountamount'])) {
			$Item = array(
				'name' => 'Discount Amount', 								// Item name. 127 char max.
				'desc' => $_SESSION['PromotionCode'], 								// Item description. 127 char max.
				'amt' => -$_SESSION['discountamount'],							// Item number.  127 char max.
				'qty' => 1, 								// Item qty on order.  Any positive integer.
				);
			array_push($itemsArray, $Item);
		}
		return $itemsArray;
	}

	/**
	 * DoExpressCheckoutPayment
	 */
	function DoExpressCheckoutPayment()
	{   
		/**
		 * Now we'll setup the request params for the final call in the Express Checkout flow.
		 * This is very similar to SetExpressCheckout except that now we can include values
		 * for the shipping, handling, and tax amounts, as well as the buyer's name and
		 * shipping address that we obtained in the GetExpressCheckoutDetails step.
		 *
		 * If this information is not included in this final call, it will not be
		 * available in PayPal's transaction details data.
		 *
		 * Once again, the template for DoExpressCheckoutPayment provides
		 * many more params that are available, but we've stripped everything
		 * we are not using in this basic demo out.
		 */

		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');

		// Get cart data from session userdata
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		$DECPFields = array(
			'token' => $PayPal_Token, 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
			'payerid' => $cart['paypal_payer_id'], 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
		);

		/**
		 * Just like with SetExpressCheckout, we need to gather our $Payment
		 * data to pass into our $Payments array.  This time we can include
		 * the shipping, handling, tax, and shipping address details that we
		 * now have.
		 */
		$discountamount = $this->session->userdata('discountamount');
		if(!empty($discountamount)){
			$TotalAmount =$this->cart->total() - $discountamount ;
		}else{
			$TotalAmount =$this->cart->total();
		}

		$Payments = array();
		$Payment = array(
			'amt' => $cart['shopping_cart']['grand_total'], 	    // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
			'itemamt' => $this->cart->format_number($TotalAmount),       // Subtotal of items only.
			'currencycode' => 'USD', 
			'discount' => $discountamount,					                                // A three-character currency code.  Default is USD.
			'shippingamt' => number_format($cart['shopping_cart']['shipping'],2), 	// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
			'handlingamt' => number_format($cart['shopping_cart']['handling'],2), 	// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
			'taxamt' => number_format($cart['shopping_cart']['tax'],2), 			// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
			'shiptoname' => $cart['shipping_name'], 					            // Required if shipping is included.  Person's name associated with this address.  32 char max.
			'shiptostreet' => $cart['shipping_street'], 					        // Required if shipping is included.  First street address.  100 char max.
			'shiptocity' => $cart['shipping_city'], 					            // Required if shipping is included.  Name of city.  40 char max.
			'shiptostate' => $cart['shipping_state'], 					            // Required if shipping is included.  Name of state or province.  40 char max.
			'shiptozip' => $cart['shipping_zip'], 						            // Required if shipping is included.  Postal code of shipping address.  20 char max.
			'shiptocountrycode' => $cart['shipping_country_code'], 				    // Required if shipping is included.  Country code of shipping address.  2 char max.
			'shiptophonenum' => $cart['phone_number'],  				            // Phone number for shipping address.  20 char max.
			'paymentaction' => 'Sale', 					                                // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
		);
		$PaymentOrderItems = array();


		$Payment['order_items'] = self::setCheckoutItems($this->cart->contents());
		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'DECPFields' => $DECPFields,
			'Payments' => $Payments,
		);

		/**
		 * Here we are making the call to the DoExpressCheckoutPayment function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */
		$PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If the call is successful, we'll save some data we might want to use
		 * later into session variables, and then redirect to our final
		 * thank you / receipt page.
		 */
		$orderID = $this->session->userdata('orderID');
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			// $orderstatusUpdate = array(
			// 			'payment_method'=>'Paypal',
			// 			'orders_status'=>'Payment Not received'
			// 			);
			// $resultst=$this->Order_Model->Save($orderID,$orderstatusUpdate);
			$response = array('Response'=>0,'Message'=>$errors);
			$this->session->set_flashdata('response',$response);
			redirect('/checkout/checkout');
		}
		else
		{
			// Successful call.
			/**
			 * Once again, since Express Checkout allows for multiple payments in a single transaction,
			 * the DoExpressCheckoutPayment response is setup to provide data for each potential payment.
			 * As such, we need to loop through all the payment info in the response.
			 *
			 * The library helps us do this using the GetExpressCheckoutPaymentInfo() method.  We'll
			 * load our $payments_info using that method, and then loop through the results to pull
			 * out our details for the transaction.
			 *
			 * Again, in this case we are you only working with a single payment, but we'll still
			 * loop through the results accordingly.
			 *
			 * Here, we're only pulling out the PayPal transaction ID and fee amount, but you may
			 * refer to the API reference for all the additional parameters you have available at
			 * this point.
			 *
			 * https://developer.paypal.com/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
			 */
			// $orderstatusUpdate = array(
			// 			'payment_method'=>'Paypal',
			// 			'orders_status'=>'Payment received by Paypal'
			// 			);
			// $resultst=$this->Order_Model->Save($orderID,$orderstatusUpdate);
			foreach($PayPalResult['PAYMENTS'] as $payment)
			{
				$cart['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
				$cart['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
			}

			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Successful Order
			// WC changed redirect to thanks.html to simplify purchase conversion tracking
			// redirect('/checkout/thanks');
			redirect('/express_checkout/OrderComplete');
		}
	}

	/**
	 * Order Complete - Pay Return Url
	 */
	function OrderComplete()
	{
	// Get cart from session userdata
		$cart = $this->session->userdata('shopping_cart');
		if(empty($cart)) redirect('/express_checkout');
		// $transactionResponse = array(
		// 					 'PayerID'=>$cart['paypal_payer_id'],
		// 					 'TransactionID'=>$this->session->userdata('Transactiondb'),
		// 					 'Paypal_TransactionID' =>$cart['paypal_transaction_id'],
		// 					 'log'=>json_encode($cart),
		// 					 'Date'=>date('Y-m-d h:i:s',time())
		// 					);
		// $check = $this->Paypal_transaction->checkpayer($cart['paypal_transaction_id']);
		// if(empty($check)){
		// 	  $this->Paypal_transaction->Save(null,$transactionResponse);
			  $emailbody1="";
			  $emailbody1="Dear ".$cart['first_name']." ".$cart['last_name'].",<br ><br >";
			  $orderID = $this->session->userdata('orderID');
			  $cart1 = $this->cart->contents(); 
			  $emailbody2="Your order #".$orderID." has been placed, please keep a record of this receipt.<br ><br >Payment Method: Paypal<br><br>";
			  $emailbody2.="Order Details:<br ><br >";
			  $po_num = $_SESSION['po_num'];
				if(isset($po_num) && !empty($po_num)){
					$emailbody2.="PO Number: ".$po_num."<br ><br >";
				}
				$discountamount = $this->session->userdata('discountamount');	
                if(!empty($discountamount)){
					$total = number_format($this->cart->total(),2) - number_format($discountamount,2); 
				}else{
					$total = number_format($this->cart->total(),2); 
				}         
				$emailbody3 = '';
			  	foreach($cart1 as $cart_item) {
			
				  $emailbody3.="Product Name:     ".$cart_item['name']."<br >Catalog No:        ".$cart_item['catalog']."<br >Shipping method:  ".$cart_item['shippingmt']."<br >Price:           $".$cart_item['price']."<br >QTY:             ".$cart_item['qty']."<br ><br >";
				}
				$discountCode = isset($_SESSION['PromotionCode']) ? $_SESSION['PromotionCode'] : null;
				 if(isset($discountCode)) {
					$emailbody3.='Discount Code: '.$discountCode.'<br>';
				 }
				 if(isset($discountamount)){
                     $emailbody3.="Discount : $".number_format($discountamount,2)."<br >"; 
                 }
				$emailbody3.="Subtotal:        $".$total."<br >";
				$emailbody3.="S/H:             $".number_format($cart['shopping_cart']['shipping'],2)."<br >";      
		 		
				$emailbody3.="Tax:             $".number_format($cart['shopping_cart']['tax'],2)."<br >";
				$taxExemptId = $_SESSION['taxExemptId'];
				if(isset($taxExemptId)) {
					$emailbody3.="Tax Exemption Number:".$taxExemptId.'<br>';
				}
				
				$emailbody3.="Total: $".$cart['shopping_cart']['grand_total']."<br />";
				$fedexAccount = $_SESSION['fedex_account_number'];
				if(isset($fedexAccount) && !empty($fedexAccount)) {
					$emailbody3.="Fedex Account: ".$fedexAccount.'<br>';
				}
				$emailbody3.= isset($_SESSION['PreviousInfo']['scountry']) && $_SESSION['PreviousInfo']['scountry']=="United States" ? "FedEx Delivery: ".$_SESSION['PreviousInfo']['fedex_service']."<br >" : "International Shipping <br>";
				
				$emailbody3.="<br />Ship to:<br >".$this->input->post('sattn')."<br >";
				$emailbody3.=$cart['shipping_name']."<br >";
				$emailbody3.=$cart['shipping_street']."<br >";
				$emailbody3.=$cart['shipping_city'].", ";
				$emailbody3.=$cart['shipping_state']." ";
				$emailbody3.=$cart['shipping_zip']."<br >";
				$emailbody3.=$cart['shipping_country_name']."<br >";
				$emailbody3.=$cart['phone_number']." (tel)<br >";
				$emailbody3="Bill to:<br >".$_SESSION['battn']."<br >";
				$emailbody3.=$_SESSION['bcompany']."<br >";
				$emailbody3.=$_SESSION['baddr1']."<br >";
				$emailbody3.=isset($_SESSION['baddr2']) ? $_SESSION['baddr2']."<br >" : '';
				$emailbody3.=$_SESSION['bcity'].", ";
				$emailbody3.=$_SESSION['bstate']." ";
				$emailbody3.=$_SESSION['bzip']."<br >";
				$emailbody3.=$_SESSION['bcountry']."<br >";
				$emailbody3.=$_SESSION['bphone']." (tel)<br >";
				$emailbody3.=$_SESSION['bfax']." (fax)<br >";
				$emailbody3.=isset($_SESSION['PreviousInfo']['cmnts']) && !empty($_SESSION['PreviousInfo']['cmnts'])? "Notes: ".$_SESSION['PreviousInfo']['cmnts']."<br>": ''."<br >";
				$emailbody=$emailbody1.$emailbody2.$emailbody3;
				$emailbody.="<br >Your PayPal Payment has been approved for order # ".$orderID.". We are processing your order and will ship it out soon.<br ><br >Thanks,<br >Your BioAssay Systems Team<br >";
				$email = $cart['email']."," ;
				$email .="order@bioassaysys.com" .",";
				$salesemail = "order@bioassaysys.com";
				$emailtitle = "Order receipt - www.bioassaysys.com";
				$header = "From: ".$salesemail."\r\n"; 
				$header.= "MIME-Version: 1.0\r\n"; 
				$header.= "Content-type: text/html; charset=utf-8\r\n";
				$status = mail($email,$emailtitle,$emailbody, $header);
				unset($_SESSION['payEmail']);
				unset($_SESSION['battn']);
				unset($_SESSION['baddr1']);
				unset($_SESSION['bcompany']);
				unset($_SESSION['baddr2']);
				unset($_SESSION['bcity']);
				unset($_SESSION['bzip']);
				unset($_SESSION['bstate']);
				unset($_SESSION['bcountry']);
				unset($_SESSION['bphone']);
				unset($_SESSION['bfax']);

			// }
			

	     	// Set cart data into session userdata
     	
		$this->load->vars('cart', $cart);
		// Successful call.  Load view or whatever you need to do here.
		$this->cart->destroy();
		redirect('/checkout/thanks');
	}
	
	/**
	 * Order Cancelled - Pay Cancel Url
	 */
	function OrderCancelled()
	{
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');

		// Clear cart from session userdata
		$this->session->unset_userdata('shopping_cart');

		// Successful call.  Load view or whatever you need to do here.
		$this->load->view('paypal/demos/express_checkout/order_cancelled');
	}

}
