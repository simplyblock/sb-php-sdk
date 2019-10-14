<?php
include '../src/SimplySign.php';
use SimplySign\SimplySign;

// Required Data
$publicKey = "hmac_pub_1";
$privateKey = "hmac_priv_1";
$data = array('text_sample' => 'test');

$simplySign = new SimplySign($publicKey, $privateKey);
$url ='https://testnet.simplyblock.io/v1/common/create_hash/';
echo $signedData = $simplySign->GatewayRequest($url, $data);
?>
