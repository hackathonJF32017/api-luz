<?php

class Crypt {

	protected static $encrypt_method = 'AES-256-CBC';
	private static $secretKey = 'aaa';
	private static $secretIv = 'bbb';

	static function encrypt($value) {

        if(is_array($value)) {
            $value = json_encode($value);
        }

		$key = hash('sha256',self::$secretKey);
		$iv = substr(hash('sha256',self::$secretIv),0,16);
		$output = openssl_encrypt($value,self::$encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
	}
	
	static function decrypt($value) {
		$key = hash('sha256',self::$secretKey);
		$iv = substr(hash('sha256',self::$secretIv),0,16);
		$output = openssl_decrypt(base64_decode($value),self::$encrypt_method,$key,0,$iv);

		try {
			return json_decode($output, true);
		} catch(Exception $e) {
			return $output;
		}
	}
}
