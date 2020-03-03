<?php


namespace App\Tests\Entity;


use App\Entity\Trajet;
use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends testCase
{
    protected $user;

    protected $trajet;

    public function setUp()
    {
        $this->user = new User();
        $this->trajet = new Trajet();
    }

    public function testNewUser()
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->assertNull($this->user->getId());
    }

    public function testUserNom()
    {
        $this->user->setNom('patoche');
        $this->assertEquals('patoche', $this->user->getNom());
    }

    public function testUserPrenom()
    {
        $this->user->setPrenom('patrick');
        $this->assertEquals('patrick', $this->user->getPrenom());
    }

    public function testUserUsername()
    {
        $this->user->setUsername('pp');
        $this->assertEquals('pp', $this->user->getUsername());
    }

    public function testUserPassword()
    {
        $this->user->setPassword('motdepasse');
        $this->assertEquals('motdepasse', $this->user->getPassword());
    }

    public function testUserEmail()
    {
        $this->user->setEmail('mail@test.com');
        $this->assertEquals('mail@test.com', $this->user->getEmail());
    }

    public function testAddTrajetConducteur()
    {
        $this->user->addTrajetConducteur($this->trajet);
        $this->assertContains($this->trajet, $this->user->getTrajetConducteurs());
    }

    public function testAddTrajetPassager()
    {
        $this->user->addTrajetPassager($this->trajet);
        $this->assertContains($this->trajet, $this->user->getTrajetPassagers());
    }

    public function testRemoveTrajetConducteur()
    {
        $this->user->addTrajetConducteur($this->trajet);
        $this->user->removeTrajetConducteur($this->trajet);
        $this->assertNotContains($this->trajet, $this->user->getTrajetConducteurs());
    }

    public function testRemoveTrajetPassager()
    {
        $this->user->addTrajetPassager($this->trajet);
        $this->user->removeTrajetPassager($this->trajet);
        $this->assertNotContains($this->trajet, $this->user->getTrajetPassagers());
    }

    public function testRoles()
    {
        $this->user->setRoles(['ROLE_TEST']);
        $this->assertContains('ROLE_TEST', $this->user->getRoles());
        $this->assertContains('ROLE_USER', $this->user->getRoles());
    }
}