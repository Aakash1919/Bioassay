<?php
require_once(APPPATH.'libraries/authorize_sdk/autoload.php');
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
class Auth_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
    }
 
    function getMerchantAuthentication() {
        
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(\SampleCodeConstants::MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(\SampleCodeConstants::MERCHANT_TRANSACTION_KEY);
        
        return $merchantAuthentication;
    }

    function getTransactionRequestType() {
        
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount("12.23");

        return $transactionRequestType;
    }

    function getSetting1() {

        $setting1 = new AnetAPI\SettingType();
        $setting1->setSettingName("hostedPaymentButtonOptions");
        $setting1->setSettingValue("{\"text\": \"Pay\"}");
        
        return $setting1;
    }

    function getSetting2() {

        $setting2 = new AnetAPI\SettingType();
        $setting2->setSettingName("hostedPaymentOrderOptions");
        $setting2->setSettingValue("{\"show\": false}");

        return $setting2;
    }

    function getSetting3() {

        $setting3 = new AnetAPI\SettingType();
        $setting3->setSettingName("hostedPaymentReturnOptions");
        $setting3->setSettingValue(
            "{\"url\": \"https://mysite.com/receipt\", \"cancelUrl\": \"https://mysite.com/cancel\", \"showReceipt\": true}"
        );
        
        return $setting3;
    }

    function getRequestforHAS() {

        $refId = 'ref' . time();
        
        $request = new AnetAPI\GetHostedPaymentPageRequest();
        $request->setMerchantAuthentication(self::getMerchantAuthentication());
        $request->setRefId($refId);
        $request->setTransactionRequest(self::getTransactionRequestType());
        $request->addToHostedPaymentSettings(self::getSetting1());
        $request->addToHostedPaymentSettings(self::getSetting2());
        $request->addToHostedPaymentSettings(self::getSetting3());

        return $request;
    }
    function getAnAcceptPaymentPage()
    {
        $controller = new AnetController\GetHostedPaymentPageController(self::getRequestforHAS());
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            echo $response->getToken()."\n";
        } else {
            echo "ERROR :  Failed to get hosted payment page token\n";
            $errorMessages = $response->getMessages()->getMessage();
            echo "RESPONSE : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        }
        return $response;
    }
}
