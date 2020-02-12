<?php


namespace App\Tests\Entity;


use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends testCase
{
    public function testNewUser()
    {
        $user =  new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->getId());
    }

    public function testUserNom()
    {
        $user = new User();
        $user->setNom('patoche');
        $this->assertEquals('patoche', $user->getNom());
    }
}