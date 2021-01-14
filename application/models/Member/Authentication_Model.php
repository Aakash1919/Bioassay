<?php
require_once(APPPATH.'libraries/authorize_sdk/autoload.php');
require_once dirname(__FILE__).'/AuthorizeConstants.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
class Authentication_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
    }
 
    function getMerchantAuthentication() {
        
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(\AuthorizeConstants::MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(\AuthorizeConstants::MERCHANT_TRANSACTION_KEY);
        
        return $merchantAuthentication;
    }

    function getTransactionRequestType($amount, $items) {
        
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setLineItems(self::getLineItems($items));
    
        return $transactionRequestType;
    }

    function setLineItem($id,$name,$price,$qty) {
        $lineItem = new AnetAPI\LineItemType();
        
        $lineItem->setItemId($id);
        $lineItem->setName('Product');
        $lineItem->setDescription($name);
        $lineItem->setTaxable(0);
        $lineItem->setQuantity($qty);
        $lineItem->setUnitPrice($price);
        
        return $lineItem;
    }
    function getLineItems($items) {
        $itemsArray = array();
        foreach($items as $item) {
         $lineItem = self::setLineItem($item['id'],$item['name'],$item['price'], $item['qty']);
         array_push($itemsArray, $lineItem);
        }
        return $itemsArray;
    }
    public function getSetting($name=null, $value=null) {
        $setting = new AnetAPI\SettingType();
        $setting->setSettingName($name);
        $setting->setSettingValue($value);
        
        return $setting;
    }

    function getRequestforHAS($amount, $items) {

        $refId = 'ref' . time();
        
        $iframeUrl = base_url().'checkout/iFrameCommunicator';
        $thanksUrl = base_url().'checkout/thanks';
        $cancelUrl = base_url().'checkout';

        $request = new AnetAPI\GetHostedPaymentPageRequest();
        $request->setMerchantAuthentication(self::getMerchantAuthentication());
        $request->setRefId($refId);
        $request->setTransactionRequest(self::getTransactionRequestType($amount, $items));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentButtonOptions", "{\"text\": \"Pay\"}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentOrderOptions", "{\"show\": false}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentReturnOptions", "{\"url\": \"$thanksUrl\", \"cancelUrl\": \"$cancelUrl\", \"showReceipt\": true}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentIFrameCommunicatorUrl", "{\"url\": \"$iframeUrl\"}"));

        return $request;
    }
    function getAnAcceptPaymentPage($amount, $items)
    {
        $controller = new AnetController\GetHostedPaymentPageController(self::getRequestforHAS($amount, $items));
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            return $response->getToken();
        } else {
           return false;
        }
        return $response;
    }
}
