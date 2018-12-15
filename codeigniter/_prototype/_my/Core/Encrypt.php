<?php
namespace My\Core;

class Encrypt{
	private $cipher = 'AES-128-CBC';
	private $encryption_key = '';
	
	public function __construct()
	{
		if (!function_exists('openssl_encrypt'))
		{
			show_error('The Encrypt library requires the Mcrypt extension.');
		}

		log_message('info', 'Encrypt Class Initialized');
	}
	
	public function encode($string, $key = '')
	{
		return base64_encode($this->___encode($string, $this->___get_key($key)));
	}
	
	public function decode($string, $key = '')
	{
		if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string) OR base64_encode(base64_decode($string)) !== $string)
		{
			return FALSE;
		}

		return $this->___decode(base64_decode($string), $this->___get_key($key));
	}
	
	public function set_key($key = '')
	{
		$this->encryption_key = $key;
		return $this;
	}
	
	private function ___get_key($key = '')
	{
		if ($key === '')
		{
			if ($this->encryption_key !== '')
			{
				return $this->encryption_key;
			}

			$key = config_item('encryption_key');

			if (empty($key))
			{
				show_error('In order to use the encryption class requires that you set an encryption key in your config file.');
			}
		}

		return md5($key);
	}
	
	private function ___encode($data, $key)
	{
				
		$ivlen = openssl_cipher_iv_length($this->cipher);
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($data, $this->cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		//$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
		$ciphertext = ( $iv.$hmac.$ciphertext_raw );
		return $ciphertext ;
		
	}
	private function ___decode($data, $key)
	{
		//$c = base64_decode($data);
		$c = ($data);
		$ivlen = openssl_cipher_iv_length( $this->cipher );
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		
		$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		if (!hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
		{
			return FALSE;
		}
		
		$original_plaintext = openssl_decrypt($ciphertext_raw, $this->cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		
		return $original_plaintext;
	}
}