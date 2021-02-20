<?php
class PaypalPayflow extends Members_Model{

    protected $environment = 'sandbox';
    protected $mode = 'Test';

	public function __construct() {
		parent::__construct();
	}

    public function setAuthParameters($request = [])
    {
        $request['PARTNER'] = 'PayPal';
        $request['VENDOR'] = 'bioassay';
        $request['USER'] = 'basppdeveloper';
        $request['PWD'] = 'gDZd2pMbDTs@9!G';
        $request['TRXTYPE'] = 'A';

        return $request;
    }

    public function setBillingAddress($request = [])
    {
        $request['BILLTOFIRSTNAME'] = 'Aakash';
        $request['BILLTOLASTNAME'] = 'Choudhary';
        $request['BILLTOSTREET'] = '123 Main St.';
        $request['BILLTOCITY'] = 'San Jose';
        $request['BILLTOSTATE'] = 'CA';
        $request['BILLTOZIP'] = '95101';
        $request['BILLTOCOUNTRY'] = 'US';

        return $request;
    }

    public function setShippingAddress($request = [])
    {
        $request['SHIPTOFIRSTNAME'] = 'Aakash';
        $request['SHIPTOLASTNAME'] = 'Choudhary';
        $request['SHIPTOSTREET'] = '123 Main St.';
        $request['SHIPTOCITY'] = 'San Jose';
        $request['SHIPTOSTATE'] = 'CA';
        $request['SHIPTOZIP'] = '95101';
        $request['SHIPTOCOUNTRY'] = 'US';

        return $request;
    }

    public function setTransaction($request = [], $cart= [])
    {
        $request['AMT'] = $this->cart->total();
        $request['CURRENCY'] = 'USD';
        $request['CREATESECURETOKEN'] = 'Y';
        $request['SECURETOKENID'] = uniqid('MySecTokenID-');
        $request['RETURNURL'] = base_url('checkout/getPaypalResponse');
        $request['CANCELURL'] = base_url('checkout/getPaypalResponse');
        $request['ERRORURL'] = base_url('checkout/getPaypalResponse');
        
        return $request;
    }

    function setCheckoutItems($request = [], $cart) {
		$i=1;
        foreach($cart as $item) {
            $request['L_DESC'.$i] = $item['name'];
            $request['L_AMT'.$i] = $item['price'];
            $request['L_QTY'.$i] = $item['qty'];
            $i++;
        }
		return $request;
	}

    public function getRequest($cart)
    {
        $request = array();
        $request = $this->setAuthParameters($request);
        // $request = $this->setBillingAddress($request);
        // $request = $this->setShippingAddress($request);
        $request = $this->setTransaction($request, $cart); 
        $request = $this->setCheckoutItems($request, $cart);
      
        return $request;
    }

    public function runPayflow($cart)
    {
        $response = $this->run_payflow_call($this->getRequest($cart));
        
        if ($response['RESULT'] != 0) {
            return false;
        } else { 
            $securetoken = $response['SECURETOKEN'];
            $securetokenid = $response['SECURETOKENID'];
        }
        $response = "<iframe src='https://payflowlink.paypal.com?SECURETOKEN=$securetoken&SECURETOKENID=$securetokenid&MODE=$this->mode' width='1080' height='720' border='0' frameborder='0' scrolling='no' allowtransparency='true'>\n</iframe>";
        return $response;
    }
    public function parse_payflow_string($str)
    {
        $workstr = $str;
        $out = array();
        while(strlen($workstr) > 0) {
            $loc = strpos($workstr, '=');
            if($loc === FALSE) {
                $workstr = "";
                continue;
            } 
            $substr = substr($workstr, 0, $loc);
            $workstr = substr($workstr, $loc + 1); 
            
            if(preg_match('/^(\w+)\[(\d+)]$/', $substr, $matches)) {
            $count = intval($matches[2]);  
                $out[$matches[1]] = substr($workstr, 0, $count);
                $workstr = substr($workstr, $count + 1);
            } else {
                $count = strpos($workstr, '&');
                if($count === FALSE) {
                    $out[$substr] = $workstr;
                    $workstr = "";
                } else {
                    $out[$substr] = substr($workstr, 0, $count);
                    $workstr = substr($workstr, $count + 1);
                }
            }
        }
        return $out;
    }

    public function run_payflow_call($params) {  
        $paramList = array();
        foreach($params as $index => $value) {
            $paramList[] = $index . "[" . strlen($value) . "]=" . $value;
        }
        $apiStr = implode("&", $paramList);
        $endPoint = $this->mode == 'Test' ? 'https://pilot-payflowpro.paypal.com/' : 'https://payflowpro.paypal.com';
        $curl = curl_init($endPoint);    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $apiStr);
        $result = curl_exec($curl);
        // echo curl_error($curl);
        return $result === FALSE ? false : $this->parse_payflow_string($result);
    }

}