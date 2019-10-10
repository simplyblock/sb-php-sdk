<?php
require '../SimplySign/SimplySign.php';

// Required Data
$publicKey = "hmac_pub_1";
$privateKey = "hmac_priv_1";
$data = array('text_sample' => 'test');

$simplySign = new SimplySign($publicKey, $privateKey);

echo $signedData = $simplySign->GenerateSignature($data);
?>
