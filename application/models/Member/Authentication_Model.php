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

    function getTransactionRequestType($amount, $items, $extraInfo) {
        
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setBillTo(self::setBillingInfo($extraInfo));
        $transactionRequestType->setShipTo(self::setShippingInfo($extraInfo));
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setTax($this->setTax(isset($extraInfo['tax']) ? $extraInfo['tax'] : 0 ));
        $transactionRequestType->setTaxExempt(isset($extraInfo['tax_exempt_id']) ? true : false );
        $transactionRequestType->setShipping($this->setShipping(isset($extraInfo['shippingFee']) ? $extraInfo['shippingFee'] : 0 ));
        $transactionRequestType->setLineItems(self::getLineItems($items, isset($extraInfo) ? $extraInfo: []));
    
        return $transactionRequestType;
    }

    function setBillingInfo($extraInfo = null) {

        $customerAddress = new AnetAPI\CustomerAddressType();
        
        $customerAddress->setFirstName(isset($extraInfo['battn']) && !empty($extraInfo['battn']) ? $extraInfo['battn'] : $extraInfo['sattn']);
        $customerAddress->setCompany(isset($extraInfo['bcompany']) && !empty($extraInfo['bcompany']) ? $extraInfo['bcompany'] : $extraInfo['scompany']);
        $customerAddress->setAddress(isset($extraInfo['baddr1']) && !empty($extraInfo['baddr1']) ? $extraInfo['baddr1'].' '.$extraInfo['baddr2'] :$extraInfo['saddr1'].' '.$extraInfo['saddr2']);
        $customerAddress->setCity(isset($extraInfo['bcity']) && !empty($extraInfo['bcity']) ? $extraInfo['bcity'] :$extraInfo['scity']);
        $customerAddress->setState(isset($extraInfo['bstate']) && !empty($extraInfo['bstate']) ? $extraInfo['bstate'] :$extraInfo['sstate']);
        $customerAddress->setZip(isset($extraInfo['bzip']) && !empty($extraInfo['bzip']) ? $extraInfo['bzip'] :$extraInfo['szip']);
        $customerAddress->setCountry(isset($extraInfo['bcountry']) && !empty($extraInfo['bcountry']) ? $extraInfo['bcountry'] : $extraInfo['scountry']);
        
        return $customerAddress;
    }

    function setShippingInfo($extraInfo = null) {

        $customerShippingAddress = new AnetAPI\CustomerAddressType();

        $customerShippingAddress->setFirstName(isset($extraInfo['sattn']) ? $extraInfo['sattn'] :'-');
        $customerShippingAddress->setCompany(isset($extraInfo['scompany']) ? $extraInfo['scompany'] :"-");
        $customerShippingAddress->setAddress(isset($extraInfo['saddr1']) ? $extraInfo['saddr1'].' '.$extraInfo['saddr2'] :"-");
        $customerShippingAddress->setCity(isset($extraInfo['scity']) ? $extraInfo['scity'] :"-");
        $customerShippingAddress->setState(isset($extraInfo['sstate']) ? $extraInfo['sstate'] :"-");
        $customerShippingAddress->setZip(isset($extraInfo['szip']) ? $extraInfo['szip'] :"-");
        $customerShippingAddress->setCountry(isset($extraInfo['scountry']) ? $extraInfo['scountry'] :"-");

        return $customerShippingAddress;
    }

    function setTax( $amount = 0 ) {
        $tax =  new AnetAPI\ExtendedAmountType();
        $tax->setAmount($amount);
        return $tax;
    }

    function setShipping($amount = 0) {
        $shipping =  new AnetAPI\ExtendedAmountType();
        $shipping->setAmount($amount);
        return $shipping;
    }

    function setLineItem($id,$name, $desc,$price,$qty) {
        $lineItem = new AnetAPI\LineItemType();
        
        $lineItem->setItemId($id);
        $lineItem->setName($name);
        $lineItem->setDescription($desc);
        $lineItem->setTaxable(0);
        $lineItem->setQuantity($qty);
        $lineItem->setUnitPrice($price);
        
        return $lineItem;
    }
    function getLineItems($items, $extraInfo=[]) {
        $itemsArray = array();
        foreach($items as $item) {
         $lineItem = self::setLineItem($item['id'],'Product',$item['name'],$item['price'], $item['qty']);
         array_push($itemsArray, $lineItem);
        }
        if(isset($extraInfo['fedex']) || isset($extraInfo['delivery'])) {
            $fedexItem = self::setLineItem('#','Fedex',$extraInfo['fedex'].' '.$extraInfo['delivery'],0, 1);
            array_push($itemsArray, $fedexItem);
        }
        if(isset($extraInfo['taxExempt'])) {
            $TaxItem = self::setLineItem('#','Tax Exempt', $extraInfo['taxExempt'],0, 1);
            array_push($itemsArray, $TaxItem);
        }
        if(isset($extraInfo['discountCode'])) {
            $discountItem = self::setLineItem('#','Discount Code', $extraInfo['discountCode'], $extraInfo['discountAmount'], 1);
            array_push($itemsArray, $discountItem);
        }
        return $itemsArray;
    }

    public function getSetting($name=null, $value=null) {
        $setting = new AnetAPI\SettingType();
        $setting->setSettingName($name);
        $setting->setSettingValue($value);
        
        return $setting;
    }

    function getRequestforHAS($amount, $items, $extraInfo = []) {
        $refId = 'ref' . time();
        
        $iframeUrl = base_url().'checkout/iFrameCommunicator';
        $thanksUrl = base_url().'checkout/thanks';
        $cancelUrl = base_url().'checkout';

        $request = new AnetAPI\GetHostedPaymentPageRequest();
        $request->setMerchantAuthentication(self::getMerchantAuthentication());
        $request->setRefId($refId);
        $request->setTransactionRequest(self::getTransactionRequestType($amount, $items, $extraInfo));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentButtonOptions", "{\"text\": \"Pay\"}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentOrderOptions", "{\"show\": false}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentReturnOptions", "{\"url\": \"$thanksUrl\", \"cancelUrl\": \"$cancelUrl\", \"showReceipt\": false}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentIFrameCommunicatorUrl", "{\"url\": \"$iframeUrl\"}"));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentShippingAddressOptions", '{"show": false, "required": false}'));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentBillingAddressOptions", '{"show": false, "required": false}'));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentVisaCheckoutOptions", '{"apiKey":"3F9eMpx9R","displayName":"Bioassay","message":"Bioassay Message"}'));
        $request->addToHostedPaymentSettings(self::getSetting("hostedPaymentCustomerOptions", '{"showEmail": true, "requiredEmail": true, "addPaymentProfile": true}'));

        return $request;    
    }
    function getAnAcceptPaymentPage($amount, $items, $extraInfo = [])
    {
        $controller = new AnetController\GetHostedPaymentPageController(self::getRequestforHAS($amount, $items, $extraInfo));
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            return $response->getToken();
        } else {
            $errorMessages = $response->getMessages()->getMessage();
           return $errorMessages[0]->getText();
        }
    }
}
