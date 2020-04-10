<?php


namespace App\Tests\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrajetControllerTest extends WebTestCase
{
    public function testNewPageRedirectToHomepageIfNotLogin()
    {
        $client = self::createClient();
        $client->request('GET', '/trajet/new');

        self::assertResponseRedirects('/login');
    }
}