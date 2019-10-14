<?php
include '../src/SimplySign.php';
use SimplySign\SimplySign;
// Required Data
$publicKey = "hmac_pub_1";
$privateKey = "hmac_priv_1";
$data = array('hash' => '91b7029808dca67200a5b8468495846693139bde79105742608dc862209a6ae8');

$simplySign = new SimplySign($publicKey, $privateKey);

$url ='https://testnet.simplyblock.io/v1/eth/broadcast_hash/';
echo $signedData = $simplySign->GatewayRequest($url, $data);
?>
