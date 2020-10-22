<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//phpinfo();
//exit;
 /*  $ch = curl_init('https://apitest.authorize.net/xml/v1/request.api');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    $data = curl_exec($ch);
    curl_close($ch);
$ch = curl_init('https://www.howsmyssl.com/a/check');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);

$json = json_decode($data);
echo "Connection uses " . $json->tls_version ."\n";
exit;*/
  include ('vendor/autoload.php') ;
 //echo "called";
 //exit;
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");

function createCustomerProfile($email)
{
	
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
	   //sandbox
	  //   $loginid ='899QXTwfv'; 
      // $transaction_key ='3R7JEt8n5p4eG4J9';
	$loginid ='3F9eMpx9R';
    $transaction_key ='62fN5K2sXaR4m5k7';
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName($loginid);
    $merchantAuthentication->setTransactionKey($transaction_key);
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create a Customer Profile Request
    //  1. (Optionally) create a Payment Profile
    //  2. (Optionally) create a Shipping Profile
    //  3. Create a Customer Profile (or specify an existing profile)
    //  4. Submit a CreateCustomerProfile Request
    //  5. Validate Profile ID returned

    // Set credit card information for payment profile
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber("4242424242424242");
    $creditCard->setExpirationDate("2038-12");
    $creditCard->setCardCode("142");
    $paymentCreditCard = new AnetAPI\PaymentType();
    $paymentCreditCard->setCreditCard($creditCard);
    
    // Create the Bill To info for new payment type
    $billTo = new AnetAPI\CustomerAddressType();
    $billTo->setFirstName("Ellen");
    $billTo->setLastName("Johnson");
    $billTo->setCompany("Souveniropolis");
    $billTo->setAddress("14 Main Street");
    $billTo->setCity("Pecan Springs");
    $billTo->setState("TX");
    $billTo->setZip("44628");
    $billTo->setCountry("USA");
    $billTo->setPhoneNumber("888-888-8888");
    $billTo->setfaxNumber("999-999-9999");

    // Create a customer shipping address
    $customerShippingAddress = new AnetAPI\CustomerAddressType();
    $customerShippingAddress->setFirstName("James");
    $customerShippingAddress->setLastName("White");
    $customerShippingAddress->setCompany("Addresses R Us");
    $customerShippingAddress->setAddress(rand() . " North Spring Street");
    $customerShippingAddress->setCity("Toms River");
    $customerShippingAddress->setState("NJ");
    $customerShippingAddress->setZip("08753");
    $customerShippingAddress->setCountry("USA");
    $customerShippingAddress->setPhoneNumber("888-888-8888");
    $customerShippingAddress->setFaxNumber("999-999-9999");

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
    $customerProfile->setDescription("Customer 2 Test PHP");
    $customerProfile->setMerchantCustomerId("M_" . time());
    $customerProfile->setEmail($email);
    $customerProfile->setpaymentProfiles($paymentProfiles);
    $customerProfile->setShipToList($shippingProfiles);


    // Assemble the complete transaction request
    $request = new AnetAPI\CreateCustomerProfileRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setProfile($customerProfile);
	/*echo "<pre>";
	print_r($request);
	exit; */
    // Create the controller and get the response
    $controller = new AnetController\CreateCustomerProfileController($request);
     $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
     echo "<pre>";
	print_r($response );
	exit;
    
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
        echo "Succesfully created customer profile : " . $response->getCustomerProfileId() . "\n";
        $paymentProfiles = $response->getCustomerPaymentProfileIdList();
        echo "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
    } else {
        echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }
	
    return $response;
}

if (!defined('DONT_RUN_SAMPLES')) {
    createCustomerProfile("test123@test.com");
}




