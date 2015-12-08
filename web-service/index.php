<?php

class mouleAuthentificator {
	private static $base32Alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=';

	public static function getTimeStamp()
	{
		return floor(microtime(true)/30);
	}

	public static function decodeBase32($base32)
	{
		$base32 = strtoupper($base32);
		if (!preg_match('/^[A-Z2-7]+$/', $base32, $match))
			throw new Exception('Error: invalid character(s) in the base32 string.');

		$string = "";

		for ($i = 0, $buffer = 0, $j = 5; $i < strlen($base32); $i++, $j += 5) {

			$buffer = $buffer << 5;
			$buffer = $buffer + strpos(mouleAuthentificator::$base32Alpha, $base32[$i]);

			if ($j >= 8) {
				$j = $j - 8;
				$string .= chr(($buffer & (0xFF << $j)) >> $j);
			}
		}
		return ($string);
	}

	public static function hotp($key, $time)
	{
		if (strlen($key) < 8)
			throw new Exception('Error: secret key is too short. Must be at least 16 base 32 characters');
		$binTime = pack('N*', 0) . pack('N*', $time);
		$hash = hash_hmac ('sha1', $binTime, $key, true);

		return ($hash);
	}

	public static function toDec($hotp)
	{
		$offset = ord($hotp[19]) & 0xf;

	    return (
	        ((ord($hotp[$offset+0]) & 0x7f) << 24 ) |
	        ((ord($hotp[$offset+1]) & 0xff) << 16 ) |
	        ((ord($hotp[$offset+2]) & 0xff) << 8 ) |
	        (ord($hotp[$offset+3]) & 0xff)
	    ) % pow(10, 6);
	}

	public static function totp($hotp)
	{
		return str_pad(mouleAuthentificator::toDec($hotp), 6, '0', STR_PAD_LEFT);
	}
}

if(isset($_GET["key"]) && strlen($_GET["key"]) > 0)
{
	$secretKey32 = $_GET["key"];

	try 
	{
		$timeStamp = mouleAuthentificator::getTimeStamp();
		$secretKey = mouleAuthentificator::decodeBase32($secretKey32);
		$hotp = mouleAuthentificator::hotp($secretKey, $timeStamp); 
		$totp = mouleAuthentificator::totp($hotp);

		echo (json_encode($totp));
	}
	catch (Exception $e)
	{
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
?>