<?php


namespace App\Tests\Entity;


use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends testCase
{
    protected $user;
    public function setUp()
    {
        $this->user = new User();
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
}