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
        // $transactionRequestType->setOrder(self::getOrder());
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
        
        $thanksUrl = base_url().'checkout/thanks';
        $cancelUrl = base_url().'checkout';
        $setting3 = new AnetAPI\SettingType();
        $setting3->setSettingName("hostedPaymentReturnOptions");
        $setting3->setSettingValue(
            "{\"url\": \"$thanksUrl\", \"cancelUrl\": \"$cancelUrl\", \"showReceipt\": true}"
        );
        
        return $setting3;
    }

    // function getOrder($order){
        
    //     $order = new AnetAPI\OrderType();
    //     $order->setInvoiceNumber(time());
    //     $order->setDescription("Golf Shirts");
        
    //     return $order;
    // }

    function getRequestforHAS($amount, $items) {

        $refId = 'ref' . time();
        
        $request = new AnetAPI\GetHostedPaymentPageRequest();
        $request->setMerchantAuthentication(self::getMerchantAuthentication());
        $request->setRefId($refId);
        $request->setTransactionRequest(self::getTransactionRequestType($amount, $items));
        $request->addToHostedPaymentSettings(self::getSetting1());
        $request->addToHostedPaymentSettings(self::getSetting2());
        $request->addToHostedPaymentSettings(self::getSetting3());

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
