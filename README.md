
# sb-php-sdk
Simplyblock php SDK for integrating REST APIs

### Platform
Php

### Requirements
Php version should be greater than or equal to 5.5.

### Usage via zip
1. Download and extract zip.
2. Create test.php file and include SimplySign.php class in it to use.

```php
<?php

require '../src/SimplySign.php';    // Change file path accordingly

$publicKey = "hmac_pub_1";    //Replace with your public key
$privateKey = "hmac_priv_1";  //Replace with your private key

//Make array of the data
$data = array('text_sample' => 'test'); 

//Create an instance of SimplySign Class
$simplySign = new SimplySign($publicKey, $privateKey);    

//Call the GenerateSignature() function to create signature
echo $signedData = $simplySign->GenerateSignature($data);    

?>
```
### Usage via composer
1. Create a composer.json in your root folder.
2. Copy and paste below code in your json file.

```json
{
	"name": "mahesh-syncrasy/sb-php-sdk",
	"description": "Simplyblock php SDK for integrating REST APIs",
	"require": {
		"Mahesh-Syncrasy/sb-php-sdk": "^1.0"
	},
	"repositories": [{
		"type": "github",
		"url": "https://github.com/Mahesh-Syncrasy/sb-php-sdk.git"
	}]
}

```
3. Then run composer update command to get the dependencies.
4. Create a test.php file in your root folder.
5. Copy and paste below code and save.

```php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';
use SimplySign\SimplySign;

//Make array of the data
$data = array('text_sample' => 'test'); 
$simplySign = new SimplySign(PUBLIC_KEY, PRIVATE_KEY);
$url ='https://testnet.simplyblock.io/v1/common/create_hash/';
echo $response = $simplySign->GatewayRequest($url, $data);

```

