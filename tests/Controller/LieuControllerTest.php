<?php


namespace App\Tests\Controller;


use App\Entity\Lieu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LieuControllerTest extends WebTestCase
{
    public function testNewPageRedirectToHomepageIfNotLogin()
    {
        $client = self::createClient();
        $client->request('GET', '/lieu/new');

        self::assertResponseRedirects('/login');
    }

    public function testCreateNewLieu()
    {
        $client = self::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'username',
                'PHP_AUTH_PW'   => 'password',
            ]
        );
        $crawler = $client->request('GET', '/lieu/new');

        $form = $crawler->selectButton('Save')->form();

        $form['lieu[nom]'] = 'nouveau lieu';
        $form['lieu[longitude]'] = '10';
        $form['lieu[latitude]'] = '20';
        $client->submit($form);

        $em = self::$container->get(EntityManagerInterface::class);

        $repo = $em->getRepository(Lieu::class);
        /** @var Lieu $lieu */
        $lieu = $repo->findOneByNom('nouveau lieu');

        self::assertNotEmpty($lieu);
        self::assertEquals('10', $lieu->getLongitude());
        self::assertEquals('20', $lieu->getLatitude());
    }
}