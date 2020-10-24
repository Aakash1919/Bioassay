<?php
require_once(APPPATH.'libraries/Authorize/autoload.php');
require_once dirname(__FILE__).'\AuthorizeConstants.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class Auth_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	function chargeCreditCard($authnetValues,$company) {
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(AuthorizeConstants::MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(AuthorizeConstants::MERCHANT_TRANSACTION_KEY);
    // Set the transaction's refId
        $refId = 'ref' . time();
    // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($authnetValues['x_card_num']);
        $creditCard->setExpirationDate($authnetValues['x_exp_date']);
        $creditCard->setCardCode($authnetValues['x_card_code']);
    // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
    // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($authnetValues['x_invoice_num']);
        $order->setDescription($authnetValues['x_description']);
    // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($authnetValues['x_first_name']);
        $customerAddress->setLastName($authnetValues['x_last_name']);
        $customerAddress->setCompany($company);
        $customerAddress->setAddress($authnetValues['x_address']);
        $customerAddress->setCity($authnetValues['x_city']);
        $customerAddress->setState($authnetValues['x_state']);
        $customerAddress->setZip($authnetValues['x_zip']);
        $customerAddress->setCountry($authnetValues['x_country']);
    // Set the customer's identifying information

        $id = time();
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId($id);
        $customerData->setEmail($authnetValues['x_email']);
    // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");
    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
        $merchantDefinedField1 = new AnetAPI\UserFieldType();
        $merchantDefinedField1->setName("Order Number");
        $merchantDefinedField1->setValue($authnetValues['x_invoice_num']);
        $merchantDefinedField2 = new AnetAPI\UserFieldType();
        $merchantDefinedField2->setName("Merchant Email");
        $merchantDefinedField2->setValue($authnetValues['x_merchant_email']);
    // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($authnetValues['x_amount']);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        $transactionRequestType->addToUserFields($merchantDefinedField1);
        $transactionRequestType->addToUserFields($merchantDefinedField2);
    // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
    // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
   // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();
        
                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $resultAuth = array(
                                        'response_code'=>$tresponse->getResponseCode(),
                                        'human_read_response_code'=>$tresponse->getMessages()[0]->getDescription(),
                                        'approval_code'=>$tresponse->getAuthCode(),
                                        'transaction_id_gateway'=>$tresponse->getTransId(),
                                        'mdhash'=>"",
                                    );
                } else {
                    if ($tresponse->getErrors() != null) {               
                        $resultAuth = array(
                                            'response_code'=>$tresponse->getErrors()[0]->getErrorCode(),
                                            'human_read_response_code'=>"Transaction Failed",
                                            'approval_code'=>$tresponse->getErrors()[0]->getErrorText(),
                                            'transaction_id_gateway'=>$tresponse->getTransId(),
                                            'mdhash'=>"",
                                        );
                    }
                }
            // Or, print errors if the API request wasn't successful
            } else {
                $tresponse = $response->getTransactionResponse();
                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $resultAuth = array(
                                        'response_code'=>$tresponse->getErrors()[0]->getErrorCode(),
                                        'human_read_response_code'=>"Transaction Failed",
                                        'approval_code'=>$tresponse->getErrors()[0]->getErrorText(),
                                        'transaction_id_gateway'=>$tresponse->getTransId(),
                                        'mdhash'=>"",
                                    );
                } else {
                    $resultAuth = array(
                                        'response_code'=>$response->getMessages()->getMessage()[0]->getCode(),
                                        'human_read_response_code'=>"Transaction Failed",
                                        'approval_code'=>$response->getMessages()->getMessage()[0]->getText(),
                                        'transaction_id_gateway'=>"",
                                        'mdhash'=>"",
                                    );
                }
            }
        } else {
            $resultAuth = array(
                                'response_code'=>"",
                                'human_read_response_code'=>"No response returned",
                                'approval_code'=>"No value returned",
                                'transaction_id_gateway'=>"",
                                'mdhash'=>"",
                            );
        }
        return $resultAuth;
    }

	function createCustomerProfile($email,$creditcard,$expire_date,$cvv,$firstname,$lastname,$company,$address,$city,$state,$zip,$country,$phone,$fax,$sfistname,$slastname,$scompany,$saddress,$scity,$sstate,$szip,$scountry,$sphone,$sfax)
	{  
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName(AuthorizeConstants::MERCHANT_LOGIN_ID);
		$merchantAuthentication->setTransactionKey(AuthorizeConstants::MERCHANT_TRANSACTION_KEY);

		$refId = 'ref' . time();
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($creditcard);
		$creditCard->setExpirationDate($expire_date);
		$creditCard->setCardCode($cvv);
		$paymentCreditCard = new AnetAPI\PaymentType();
		$paymentCreditCard->setCreditCard($creditCard);
	    // Create the Bill To info for new payment type
		$billTo = new AnetAPI\CustomerAddressType();
		$billTo->setFirstName($firstname);
		$billTo->setLastName($lastname);
		$billTo->setCompany($company);
		$billTo->setAddress($address);
		$billTo->setCity($city);
		$billTo->setState($state);
		$billTo->setZip($zip);
		$billTo->setCountry($country);
		$billTo->setPhoneNumber($phone);
		$billTo->setfaxNumber($fax);
	    // Create a customer shipping address
		$customerShippingAddress = new AnetAPI\CustomerAddressType();
		$customerShippingAddress->setFirstName($sfistname);
		$customerShippingAddress->setLastName($slastname);
		$customerShippingAddress->setCompany($scompany);
		$customerShippingAddress->setAddress($saddress);
		$customerShippingAddress->setCity($scity);
		$customerShippingAddress->setState($sstate);
		$customerShippingAddress->setZip($szip);
		$customerShippingAddress->setCountry($scountry);
		$customerShippingAddress->setPhoneNumber($sphone);
		$customerShippingAddress->setFaxNumber($sfax);
	    // Create an array of any shipping addresses
		$shippingProfiles[] = $customerShippingAddress;
	    // Create a new CustomerPaymentProfile object
		$paymentProfile = new AnetAPI\CustomerPaymentProfileType();
		$paymentProfile->setCustomerType('individual');
		$paymentProfile->setBillTo($billTo);
		$paymentProfile->setPayment($paymentCreditCard);
		$paymentProfile->setDefaultpaymentProfile(true);
		$paymentProfiles[] = $paymentProfile;
		// Create a new CustomerProfileType and add the payment profile object
		$customerProfile = new AnetAPI\CustomerProfileType();
		$customerProfile->setDescription("Bioassay Customer");
		$customerProfile->setMerchantCustomerId("M_" . time());
		$customerProfile->setEmail($email);
		$customerProfile->setpaymentProfiles($paymentProfiles);
		$customerProfile->setShipToList($shippingProfiles);
		// Assemble the complete transaction request
		$request = new AnetAPI\CreateCustomerProfileRequest();
		$request->setMerchantAuthentication($merchantAuthentication);
		$request->setRefId($refId);
		$request->setProfile($customerProfile);

		$controller = new AnetController\CreateCustomerProfileController($request);
		//$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
		    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

		if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
			$data = "Succesfully created customer profile : " . $response->getCustomerProfileId() . "\n";
			$paymentProfiles = $response->getCustomerPaymentProfileIdList();
			$data .= "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
            $rdata = array('response'=>$data,'profileID'=>$response->getCustomerProfileId(),'paymentprofileID'=>$paymentProfiles[0]);
		} else {
			$data = "ERROR :  Invalid response\n";
			$errorMessages = $response->getMessages()->getMessage();
			$data.= "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
		 $rdata = array('response'=>$data,'profileID'=>null,'paymentprofileID'=>null);
        }
        // print_r($rdata);
        // exit;
		 return $rdata;
	}
 function chargeCustomerProfile($profileid, $paymentprofileid, $amount)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(AuthorizeConstants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(AuthorizeConstants::MERCHANT_TRANSACTION_KEY);
    // Set the transaction's refId
    $refId = 'ref' . time();
    $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
    $profileToCharge->setCustomerProfileId($profileid);
    $paymentProfile = new AnetAPI\PaymentProfileType();
    $paymentProfile->setPaymentProfileId($paymentprofileid);
    $profileToCharge->setPaymentProfile($paymentProfile);
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setProfile($profileToCharge);
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId( $refId);
    $request->setTransactionRequest( $transactionRequestType);
    $controller = new AnetController\CreateTransactionController($request);
    //$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
       if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
            
            if ($tresponse != null && $tresponse->getMessages() != null) {
               
                 $resultAuth = array('response_code'=>$tresponse->getResponseCode(),
                    'human_read_response_code'=>$tresponse->getMessages()[0]->getDescription(),
                    'approval_code'=>$tresponse->getAuthCode(),
                    'transaction_id_gateway'=>$tresponse->getTransId(),
                    'mdhash'=>"",
                    );
            } else {
                 if ($tresponse->getErrors() != null) {
                  
                    $resultAuth = array('response_code'=>$tresponse->getErrors()[0]->getErrorCode(),
                    'human_read_response_code'=>"Transaction Failed",
                    'approval_code'=>$tresponse->getErrors()[0]->getErrorText(),
                    'transaction_id_gateway'=>$tresponse->getTransId(),
                    'mdhash'=>"",
                    );
                }

                 
            }
            // Or, print errors if the API request wasn't successful
        } else {
    
            $tresponse = $response->getTransactionResponse();
        
             $resultAuth = array('response_code'=>$response->getMessages()->getMessage()[0]->getCode(),
                    'human_read_response_code'=>"Transaction Failed",
                    'approval_code'=>$response->getMessages()->getMessage()[0]->getText(),
                    'transaction_id_gateway'=>$tresponse->getTransId(),
                    'mdhash'=>"",
                    );
        }
    } else {
       $resultAuth = array('response_code'=>"",
                    'human_read_response_code'=>"No response returned",
                    'approval_code'=>"No value returned",
                    'transaction_id_gateway'=>"",
                    'mdhash'=>"",
                    );
    }
    return $resultAuth;
  }
	function createPayment($x_card_num,$x_exp_date,$x_card_code,$x_first_name,$billCompany,$x_address,$x_city,$x_state,$x_zip,$x_country,$x_phone,$x_fax,$sattn,$scompany,$saddress,$scity,$sstate,$szip,$scountry,$sphone,$sFax,$semail,$authnet_values,$auth_net_url){
		// Customer Information Manager Started
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName(AuthorizeConstants::MERCHANT_LOGIN_ID);
		$merchantAuthentication->setTransactionKey(AuthorizeConstants::MERCHANT_TRANSACTION_KEY);
        $lastfourcc =  substr($x_card_num, -4);
        // Set the transaction's refId
    
        $refId = 'ref' . time();
    // Set credit card information for payment profile
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($x_card_num);
    $creditCard->setExpirationDate($x_exp_date);
    $creditCard->setCardCode($x_card_code);
    $paymentCreditCard = new AnetAPI\PaymentType();
    $paymentCreditCard->setCreditCard($creditCard);

    // Create the Bill To info for new payment type

    $billTo = new AnetAPI\CustomerAddressType();
    $billTo->setFirstName($x_first_name);
    $billTo->setLastName("");
    $billTo->setCompany($billCompany);
    $billTo->setAddress($x_address);
    $billTo->setCity($x_city);
    $billTo->setState($x_state);
    $billTo->setZip($x_zip);
    $billTo->setCountry($x_country);
    $billTo->setPhoneNumber($x_phone);
    $billTo->setFaxNumber($x_fax);

    // Create a customer shipping address
    $customerShippingAddress = new AnetAPI\CustomerAddressType();
    $customerShippingAddress->setFirstName($sattn);
    $customerShippingAddress->setLastName("");
    $customerShippingAddress->setCompany($scompany);
    $customerShippingAddress->setAddress($saddress);
    $customerShippingAddress->setCity($scity);
    $customerShippingAddress->setState($sstate);
    $customerShippingAddress->setZip($szip);
    $customerShippingAddress->setCountry($scountry);
    $customerShippingAddress->setPhoneNumber($sphone);
    $customerShippingAddress->setFaxNumber($sFax);

    // Create an array of any shipping addresses
    $shippingProfiles[] = $customerShippingAddress;


    // Create a new CustomerPaymentProfile object
    $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
    $paymentProfile->setCustomerType('individual');
    $paymentProfile->setBillTo($billTo);
    $paymentProfile->setPayment($paymentCreditCard);
    $paymentProfile->setDefaultpaymentProfile(true);
    $paymentProfiles[] = $paymentProfile;


    // Create a new CustomerProfileType and add the payment profile object
    $customerProfile = new AnetAPI\CustomerProfileType();
    $customerProfile->setDescription("On-line Credit Card Order");
    $customerProfile->setMerchantCustomerId("M_" . time());
    $customerProfile->setEmail($semail);
    $customerProfile->setpaymentProfiles($paymentProfiles);
    $customerProfile->setShipToList($shippingProfiles);


    // Assemble the complete transaction request
    $request = new AnetAPI\CreateCustomerProfileRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setProfile($customerProfile);

    // Create the controller and get the response
    $controller = new AnetController\CreateCustomerProfileController($request);
    //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

    //$msg = "Response: ".json_encode($response)."Controller:".json_encode($controller);
    //mail("programmer.ck@gmail.com","Authorize Response",$msg);
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
    	//echo "Succesfully created customer profile : " . $response->getCustomerProfileId() . "\n";
    	$paymentProfiles = $response->getCustomerPaymentProfileIdList();
    	///echo "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
       $personID = $this->session->userdata('person_id');
       if(isset($personID)){
       $UpdateData = array('AuthorizeProfilePaymentID'=>$paymentProfiles[0],'AuthorizeProfileID'=>$response->getCustomerProfileId(),'cc_four'=>$lastfourcc);
        $this->SaveData($personID,$UpdateData); 
       }
       
    } else {
    //	echo "ERROR :  Invalid response\n";
    	$errorMessages = $response->getMessages()->getMessage();
    //	echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }
	// Customer Information Manager Ending
    $resultAakash = $this->chargeCreditCard($authnet_values,$billCompany);
	return $resultAakash;   
}
    public function SaveData($id,$data) {
        $this->db->where('person_id',$id);
        $this->db->update('users',$data);
        $result = $id;
        return $result;
    }
    function getMerchantAuthentication() { 

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(\AuthorizeConstants::MERCHANT_TRANSACTION_KEY); 
        
        return $merchantAuthentication;
    }

    function getPaypalType() {
        
        $payPalType = new AnetAPI\PayPalType();
        $payPalType->setCancelUrl(site_url('/checkout/checkout?fromCart=true'));
        $payPalType->setSuccessUrl(site_url('/checkout/thanks'));
        
        return $payPalType;
    }
        
    function getPaymentOne() {
        
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setPayPal(self::getPayPalType());

        return $paymentOne;
    }

    public function getLineItem() {
        
        $lineItem = new AnetAPI\LineItemType();
        
        $lineItem->setItemId("12345");
        $lineItem->setName("first");
        $lineItem->setDescription("Here's the first line item");
        $lineItem->setQuantity(2);
        $lineItem->setUnitPrice("7.99");
        
        return $lineItem;
    }

    function getLineItems() {
        $lineItems[0] = self::getLineItem();
        $lineItems[1] = self::getLineItem();

        return $lineItems;
    }

    function getTransactionRequestType($amount) {
       
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType( "authOnlyTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment(self::getPaymentOne());
        $transactionRequestType->setLineItems(self::getLineItems());
        
        return $transactionRequestType;
    }

    function getRequest($amount) {
        
        $refId = '123';

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication(self::getMerchantAuthentication());
        $request->setRefId( $refId);
        $request->setTransactionRequest( self::getTransactionRequestType($amount) );
        
        return $request;
    }
    function payPalAuthorizeOnly($amount) {
        $controller = new AnetController\CreateTransactionController( self::getRequest($amount) );
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if ($response != null) {
            if($response->getMessages()->getResultCode() == "Ok") {
                $tresponse = $response->getTransactionResponse();
                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $response = self::jsonResponse(200,'Success',$tresponse->getSecureAcceptance()->getSecureAcceptanceUrl());
                } else {
                    if($tresponse->getErrors() != null) {
                        $response = self::jsonResponse($tresponse->getErrors()[0]->getErrorCode(),$tresponse->getErrors()[0]->getErrorText(),null);
                    }
                }
            } else {
                $tresponse = $response->getTransactionResponse();
                if($tresponse != null && $tresponse->getErrors() != null) {
                    $response = self::jsonResponse($tresponse->getErrors()[0]->getErrorCode(),$tresponse->getErrors()[0]->getErrorText(),null);
                } else {
                    $response = self::jsonResponse($response->getMessages()->getMessage()[0]->getCode(),$response->getMessages()->getMessage()[0]->getText(),null);
                }
            }
        } else {
            $response = self::jsonResponse(500,'No response returned from Paypal',null);
        }
        return $response;
    }

    function jsonResponse($status,$message,$url) {
        return json_encode([
            'status' => $status,
            'message' => $message,
            'url'=>$url  
            ]);
    }
}