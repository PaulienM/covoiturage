<?php


namespace App\Tests\Controller;


use App\Tests\TestHelper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testStatusCodeRegistration()
    {
        $client = self::createClient();
        $client->request('GET', '/register');
        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRedirectLoggedUserToHomepage()
    {
        $client = self::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'username',
                'PHP_AUTH_PW'   => 'password',
            ]
        );
        $client->request('GET', '/register');
        self::assertResponseRedirects('/');
    }
}