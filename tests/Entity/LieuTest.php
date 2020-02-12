<?php


namespace App\Tests\Entity;


use Monolog\Test\TestCase;
use App\Entity\Lieu;

class LieuTest extends TestCase
{
    protected $lieu;

    public function setUp()
    {
        $this->lieu = new Lieu();
    }

    public function testLieu()
    {
        $this->assertInstanceOf(Lieu::class, $this->lieu);
        $this->assertNull($this->lieu->getId());
    }

    public function testLieuNom()
    {
        $this->lieu->setNom("ici");
        $this->assertEquals("ici", $this->lieu->getNom());
    }

    public function testLieuLatitude()
    {
        $this->lieu->setLatitude(0.01);
        $this->assertEquals(0.01, $this->lieu->getLatitude());
    }

    public function testLieuLongitude()
    {
        $this->lieu->setLongitude(0.01);
        $this->assertEquals(0.01, $this->lieu->getLongitude());
    }
}