<?php


namespace App\Tests\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{

    private const FORM_NAME = 'registration_form';

    private $formFields;

    protected function setUp()
    {
        $this->formFields = [
            ['type' => 'text', 'name' => 'username'],
            ['type' => 'text', 'name' => 'prenom'],
            ['type' => 'text', 'name' => 'nom'],
            ['type' => 'email', 'name' => 'email'],
            ['type' => 'password', 'name' => 'plainPassword'],
            ['type' => 'checkbox', 'name' => 'agreeTerms'],
            ['type' => 'hidden', 'name' => '_token'],
        ];
    }

    public function testStatusCodeRegistration()
    {
        $client = $this->createClient();
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

    public function testFormFieldInRegistrationPage()
    {
        $client = self::createClient();
        $client->request('GET', '/register');

        foreach ($this->formFields as $formField) {
            self::assertSelectorExists(
                'input[type="'.$formField['type'].'"]#'.self::FORM_NAME.'_'
                .$formField['name']
            );
        }
    }

    public function testCreateNewUser()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Register')->form();

        $form['registration_form[username]'] = 'user';
        $form['registration_form[prenom]'] = 'prenom';
        $form['registration_form[nom]'] = 'nom';
        $form['registration_form[email]'] = 'email@test.com';
        $form['registration_form[plainPassword]'] = 'password';
        $form['registration_form[agreeTerms]'] = '1';
        $client->submit($form);

        $em = self::$container->get(EntityManagerInterface::class);

        $repo = $em->getRepository(User::class);
        /** @var User $user */
        $user = $repo->findOneByUsername('user');

        self::assertNotEmpty($user);
        self::assertContains('ROLE_USER', $user->getRoles());
    }
}