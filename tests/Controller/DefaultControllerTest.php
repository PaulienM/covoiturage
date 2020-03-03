<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest  extends WebTestCase
{
    public function testIndex() {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW' => 'password',
        ]);
        $client->followRedirects();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

/*        $this->assertSelectorNotExists('a[href="/login"]');
        $this->assertSelectorNotExists('a[href="/registrer"]');
        $this->assertSelectorExists('a[href="/logout"]');

        $this->assertSelectorExists('a[href="/trajet/new"]');
        $this->assertSelectorText('a[href="/trajet/new"]');*/

    }

    // Connexion
    public function testLogin () {
        // lien de connexion
        $client = static::createClient();
        // requete sur page accueil
        $doc = $client->request('GET', '/');
        $this->assertNotEmpty($client->getResponse()->getStatusCode());
        // chercher login
        $link = $doc->selectLink( "Login");
        $this->assertEquals(1, $link->count());
    }
}