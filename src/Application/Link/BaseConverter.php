<?php


namespace App\Application\Link;


use App\Model\Link\BaseConverterInterface;

class BaseConverter implements BaseConverterInterface
{
    public function toBase(int $number, int $base = 62, int $seed = null): string
    {
        if (!$seed) {
            random_int(pow(10, 10), pow(10, 11) - 1);
        }

        $number += $seed;
        $chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $r = $number % $base;
        $res = $chars[$r];
        $q = floor($number / $base);
        while ($q) {
            $r = $q % $base;
            $q = floor($q/$base);
            $res = $chars[$r].$res;
        }
        return $res;
    }

    function convertUuidToBase(string $uuid, int $base = 62): string
    {
        $sum = '';
        foreach(str_split($uuid) as $char) {
            $sum .= ord($char);
        }

        $number = intval($sum);
        $chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $r = $number % $base;
        $res = $chars[$r];
        $q = floor($number / $base);
        while ($q) {
            $r = $q % $base;
            $q = floor($q/$base);
            $res = $chars[$r].$res;
        }
        return $res;
    }
}