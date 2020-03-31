<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testStatusCodeRegistration()
    {
        $client = self::createClient();
        $client->request('GET', '/register');
        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}