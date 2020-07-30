<?php


namespace App\Model\Link;


interface BaseConverterInterface
{
    function convertUuidToBase(string $uuid, int $base = 62): string;
}