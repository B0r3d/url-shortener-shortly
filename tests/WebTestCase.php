<?php


namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class WebTestCase extends \Liip\FunctionalTestBundle\Test\WebTestCase
{
    private KernelBrowser $client;

    public function getHttpClient(): KernelBrowser
    {
        if (!isset($this->client) || $this->client === null) {
            $this->client = $this->createClient();
        }

        return $this->client;
    }
}