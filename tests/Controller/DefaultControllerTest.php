<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest  extends WebTestCase
{
    public function testHomepage()
    {
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHomepageUser()
    {
        $client = self::createClient(
                [],
                [
                        'PHP_AUTH_USER' => 'username',
                        'PHP_AUTH_PW'   => 'password',
                ]
        );
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testElementInHomepageAnonymous()
    {
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertSelectorExists('a[href="/login"]');
        $this->assertSelectorExists('a[href="/register"]');
        $this->assertSelectorNotExists('a[href="/logout"]');
    }

    public function testElementInHomepageUser()
    {
        $client = self::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'username',
                'PHP_AUTH_PW'   => 'password',
            ]
        );
        $client->request('GET', '/');
        $this->assertSelectorNotExists('a[href="/login"]');
        $this->assertSelectorNotExists('a[href="/register"]');
        $this->assertSelectorExists('a[href="/logout"]');
    }
}