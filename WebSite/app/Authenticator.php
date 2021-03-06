<?php
namespace App;

class Authenticator
{
    private static $base32Alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=';

    public static function getTimeStamp()
    {
        return (floor(microtime(true) / 30));
    }

    private static function decodeBase32($base32)
    {
        $base32 = strtoupper($base32);
        if (!preg_match('/^[A-Z2-7]+$/', $base32, $match))
            throw new \Exception('Error: invalid character(s) in the base32 string.');

        $string = "";

        for ($i = 0, $buffer = 0, $j = 5; $i < strlen($base32); $i++, $j += 5) {

            $buffer = $buffer << 5;
            $buffer = $buffer + strpos(Authenticator::$base32Alpha, $base32[$i]);

            if ($j >= 8) {
                $j = $j - 8;
                $string .= chr(($buffer & (0xFF << $j)) >> $j);
            }
        }
        return ($string);
    }

    private static function generateHmac($key, $time)
    {
        if (strlen($key) < 8)
            throw new \Exception('Error: secret key is too short. Must be at least 16 base 32 characters');

        $binTime = pack('N*', 0) . pack('N*', $time);
        $hash = hash_hmac ('sha1', $binTime, $key, true);

        return ($hash);
    }

    private static function dynamicTruncation($hash)
    {
        $offset = ord($hash[19]) & 0xf;

        return ((
            ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
            ((ord($hash[$offset+1]) & 0xff) << 16 ) |
            ((ord($hash[$offset+2]) & 0xff) << 8 ) |
            (ord($hash[$offset+3]) & 0xff)
        ) % pow(10, 6));
    }

    private static function totp($hash)
    {
        return (str_pad(Authenticator::dynamicTruncation($hash), 6, '0', STR_PAD_LEFT));
    }

    public static function getCode($key)
    {
        $timestamp = Authenticator::getTimeStamp();
        $secretKey = Authenticator::decodeBase32($key);
        $hash = Authenticator::generateHmac($secretKey, $timestamp);
        $totp = Authenticator::totp($hash);

        return ($totp);
    }
}
