<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trajet;
use App\Entity\Lieu;
use App\Entity\User;


class TrajetTest extends TestCase
{
    protected $trajet;

    protected $lieu;

    public function setUp()
    {
        $this->trajet = new Trajet();
        $this->lieu = new Lieu();
    }

    public function testTrajet()
    {
        $this->assertInstanceOf(Trajet::class, $this->trajet);
        $this->assertNull($this->trajet->getId());
    }

    public function testTrajetPlaces()
    {
        $this->trajet->setPlaces(2);
        $this->assertEquals(2, $this->trajet->getPlaces());
    }

    public function testTrajetDatetime()
    {
        $date = new \DateTime();
        $this->trajet->setDatetime($date);
        $this->assertEquals($date, $this->trajet->getDatetime());
    }

    public function testTrajetLieuDepart()
    {
        $this->trajet->setLieudepart($this->lieu);
        $this->lieu->addDeparttrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuDepart());
        $this->assertContains($this->trajet, $this->lieu->getDeparttrajets());
    }

    public function testTrajetLieuArrivee()
    {
        $this->trajet->setLieuarrivee($this->lieu);
        $this->lieu->addArriveetrajet($this->trajet);
        $this->assertEquals($this->lieu, $this->trajet->getLieuarrivee());
        $this->assertContains($this->trajet, $this->lieu->getArriveetrajets());
    }

    public function testTrajetConducteur()
    {
        $user = new User();
        $this->trajet->setConducteur($user);
        $user->addTrajetConducteur($this->trajet);
        $this->assertEquals($user, $this->trajet->getConducteur());
        $this->assertContains($this->trajet, $user->getTrajetConducteurs());
    }

    public function testTrajetPassager()
    {
        $user = new User();
        $this->trajet->addPassager($user);
        $user->addTrajetPassager($this->trajet);
        $this->assertContains($user, $this->trajet->getPassagers());
        $this->assertContains($this->trajet, $user->getTrajetPassagers());
    }

    public function testRemovePassager()
    {
        $user = new User();
        $this->trajet->addPassager($user);
        $this->trajet->removePassager($user);
        $this->assertNotContains($user, $this->trajet->getPassagers());
    }

    public function testAddTrajetInLieu()
    {
        $this->trajet->setLieuDepart($this->lieu);
        $this->assertContains($this->trajet, $this->lieu->getDepartTrajets());

        $this->trajet->setLieuArrivee($this->lieu);
        $this->assertContains($this->trajet, $this->lieu->getArriveeTrajets());
    }
}