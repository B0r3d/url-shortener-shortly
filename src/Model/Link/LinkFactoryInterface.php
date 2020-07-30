<?php


namespace App\Model\Link;


use App\Model\Link\Entity\Link;

interface LinkFactoryInterface
{
    public function createLink(string $url): Link;
}