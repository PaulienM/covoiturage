<?php
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trajet;
use App\Entity\Lieu;
use App\Entity\User;


class TrajetTest extends TestCase {
    protected $trajet;

    public function setUp()  {
        $this->trajet = new Trajet();
    }

    public function testTrajet() {
        $this->assertInstanceOf(Trajet::class, $this->trajet);
        $this->assertNull($this->trajet->getId());
    }

    public function testTrajetPlaces() {
        $this->trajet->setPlaces(2);
        $this->assertEquals(2, $this->trajet->getPlaces());
    }

    public function testTrajetDatetime() {
        $date = new \DateTime();
        $this->trajet->setDatetime($date);
        $this->assertEquals($date, $this->trajet->getDatetime());
    }

    public function testTrajetLieuDepart() {
        $lieu = new Lieu();
        $this->trajet->setLieuDepart($lieu);
        $lieu->addDepartTrajet($this->trajet);
        $this->assertEquals($lieu, $this->trajet->getLieuDepart());
        $this->assertContains($this->trajet, $lieu->getDeparttrajets());
    }

    public function testTrajetLieuArrivee() {
        $lieu = new Lieu();
        $this->trajet->setLieuArrivee($lieu);
        $lieu->addArriveeTrajet($this->trajet);
        $this->assertEquals($lieu, $this->trajet->getLieuArrivee());
        $this->assertContains($this->trajet, $lieu->getArriveetrajets());
    }

    public function testTrajetConducteur() {
        $user = new User();
        $this->trajet->setConducteur($user);
        $user->addConducteurtrajet($this->trajet);
        $this->assertEquals($user, $this->trajet->getConducteur());
        $this->assertContains($this->trajet, $user->getConducteurtrajets());
    }

    public function testTrajetPassager() {
        $user = new User();
        $this->trajet->addPassager($user);
        $user->addPassagertrajet($this->trajet);
        $this->assertContains($user, $this->trajet->getPassagers());
        $this->assertContains($this->trajet, $user->getPassagertrajets());
    }

}