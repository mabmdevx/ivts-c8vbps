<?php

namespace App\Http\Utils;

require __DIR__ . "/../../../vendor/autoload.php";
use Request;

class CommonUtils {
    
    public static function do_curl_post($url, $content)
    {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($content))
        );
		$response = curl_exec($curl);
		curl_close($curl);
		
		return $response;
    }
}