<?php
include '../src/SimplySign.php';
use SimplySign\SimplySign;

// Required Data
$publicKey = "hmac_pub_1";
$privateKey = "hmac_priv_1";
$url = "https://testnet.simplyblock.io/v1/eth/contract/build/";
$filePath = "/home/syncrasy/Downloads/DappToken.sol";


 //Required Params
$data = array("contract_name" => "contact1");
$files = array("contract" => $filePath);

$simplySign = new SimplySign($publicKey, $privateKey);

echo $signedData = $simplySign->GatewayRequest($url, $data, $files);
?>
