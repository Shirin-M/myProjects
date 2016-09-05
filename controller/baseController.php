<?php
class baseController
{
	public $string;
	public $email;
	public $magicQuotes;
	public  $numberFloat;
	public  $numberInt;
	public $url;

	public function stringSanitizer($string) {

		$cleanString = filter_var($string, FILTER_SANITIZE_STRING);
		return $cleanString;
	}
	public function emailSanitizer($email) {

		$cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
		return $cleanEmail;
	}
	public function  magicQuotesSanitizer($magicQuotes)
	{
		$cleanQuotes=filter_var($magicQuotes,FILTER_SANITIZE_MAGIC_QUOTES);
		return $cleanQuotes;
	}
	public function numberFloatSanitizer($numberFloat)
	{
		$cleanFloat=filter_var($numberFloat,FILTER_SANITIZE_NUMBER_FLOAT);
		return $cleanFloat; 
	}
	public function numberIntSanitizer($numberInt)
	{
		$cleanInt=filter_var($numberFloat,FILTER_SANITIZE_NUMBER_INT);
		return $cleanInt; 
	}
	public function urlSanitizer($url)
	{
		$cleanURL=filter_var($url,FILTER_SANITIZE_URL);
		return $cleanURL;
	}
	public function spCharSanitizer($string)
	{
		$cleanString=filter_var($string,FILTER_SANITIZE_SPECIAL_CHARS);
		return $cleanString;
	}
	
}
?>