<?php 
session_start();ob_start();
error_reporting(0);
include("../includes/functions.php");
include("../model/database.php");
include("../authorize_sdk/autoload.php");

use net\authorize\api\contract\v1 as AnetAPI;


$ch = curl_init('https://www.howsmyssl.com/a/check');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);

$json = json_decode($data);
echo "Connection uses " . $json->tls_version ."\n";

$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
print_r($merchantAuthentication);



echo 'Checking Authorise on server.';



?>