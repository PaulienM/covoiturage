<?php


namespace App\Tests\Entity;


use App\Entity\Trajet;
use Monolog\Test\TestCase;
use App\Entity\Lieu;

class LieuTest extends TestCase
{
    protected $lieu;

    protected $trajet;

    public function setUp()
    {
        $this->lieu = new Lieu();
        $this->trajet = new Trajet();
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

    public function testDepartTrajet()
    {
        $this->lieu->addDepartTrajet($this->trajet);
        $this->assertContains($this->trajet, $this->lieu->getDepartTrajets());
        $this->lieu->removeDepartTrajet($this->trajet);
        $this->assertNotContains($this->trajet, $this->lieu->getDepartTrajets());
    }

    public function testArriveeTrajet()
    {
        $this->lieu->addArriveeTrajet($this->trajet);
        $this->assertContains($this->trajet, $this->lieu->getArriveeTrajets());
        $this->lieu->removeArriveeTrajet($this->trajet);
        $this->assertNotContains($this->trajet, $this->lieu->getArriveeTrajets());
    }

    public function testAddLieuInTrajet()
    {
        $this->lieu->addArriveeTrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuArrivee());

        $this->lieu->addDepartTrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuDepart());
    }

    public function testRemoveLieuInTrajet()
    {
        $this->lieu->addArriveeTrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuArrivee());
        $this->lieu->removeArriveeTrajet($this->trajet);
        $this->assertNull($this->trajet->getLieuArrivee());

        $this->lieu->addDepartTrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuDepart());
        $this->lieu->removeDepartTrajet($this->trajet);
        $this->assertNull($this->trajet->getLieuDepart());
    }
}