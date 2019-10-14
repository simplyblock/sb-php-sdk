<?php
namespace SimplySign;

Class SimplySign{

	private $public_key;
	private $private_key;
	private $data;
	private $signedData;
    


	public function __construct($public_key, $private_key)
	{
		$this->public_key = $public_key;
		$this->private_key = $private_key;
		$this->data = null;
		$this->signedData = null;
	}


	public function GenerateSignature($data)
	{
		$json_data = json_encode($data);
		$json_data = str_replace(":", ": ", $json_data);
		$json_data = str_replace('"', "'", $json_data);
		$this->signedData = hash_hmac( 'sha384' , $json_data, $this->private_key);
		return $this->signedData; 
	}

	public function GatewayRequest($uri, $data, $files=[])
	{

		$signedData = $this->GenerateSignature($data);
		$requestData['public_key'] = $this->public_key;
		$requestData['signed_data'] = $signedData;

		

		if(is_array($files) && count($files) > 0)
		{
			$content_type = "Content-Type: multipart/form-data";

			foreach ($data as $key => $value) {
				$requestData[$key] = $value;
			}

			foreach ($files as $filekey => $filevalue) {
				$file = $filevalue;
				$mime = mime_content_type($filevalue);
				$info = pathinfo($file);
				$name = $info['basename'];

				$requestData[$filekey] = new cURLFile($filevalue, $mime, $name);
			}

			$requestDataJson = $requestData;
		}
		else
		{
			$content_type = "Content-Type: application/json";
			$requestData['data'] = $data;
			$requestDataJson = json_encode($requestData);
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $uri,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $requestDataJson,
			CURLOPT_HTTPHEADER => array($content_type,"cache-control: no-cache"),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			$response['success'] = false;
			$response['errors'][] = $err;
			return json_encode($response);
		} else {
			$response_decode = json_decode($response);
			if(!trim($response_decode->success))
			{
				$error[] = $response_decode->message;
				$response_decode->errors = $error;
			}
			return json_encode($response_decode);
		}
	} 
}