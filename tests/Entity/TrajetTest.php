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
    
    protected $user;

    public function setUp()
    {
        $this->trajet = new Trajet();
        $this->lieu = new Lieu();
        $this->user = new User();
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
        $this->trajet->setConducteur($this->user);
        $this->user->addTrajetConducteur($this->trajet);
        $this->assertEquals($this->user, $this->trajet->getConducteur());
        $this->assertContains($this->trajet, $this->user->getTrajetConducteurs());
    }

    public function testTrajetPassager()
    {
        $this->trajet->addPassager($this->user);
        $this->user->addTrajetPassager($this->trajet);
        $this->assertContains($this->user, $this->trajet->getPassagers());
        $this->assertContains($this->trajet, $this->user->getTrajetPassagers());
    }

    public function testRemovePassager()
    {
        $this->trajet->addPassager($this->user);
        $this->trajet->removePassager($this->user);
        $this->assertNotContains($this->user, $this->trajet->getPassagers());
    }

    public function testAddTrajetInLieu()
    {
        $this->trajet->setLieuDepart($this->lieu);
        $this->assertContains($this->trajet, $this->lieu->getDepartTrajets());

        $this->trajet->setLieuArrivee($this->lieu);
        $this->assertContains($this->trajet, $this->lieu->getArriveeTrajets());
    }

    public function testAddTrajetInUser()
    {
        $this->trajet->setConducteur($this->user);
        $this->assertContains($this->trajet, $this->user->getTrajetConducteurs());

        $this->trajet->addPassager($this->user);
        $this->assertContains($this->trajet, $this->user->getTrajetPassagers());
    }

    public function testRemoveTrajetInUser()
    {
        $this->trajet->addPassager($this->user);
        $this->assertContains($this->trajet, $this->user->getTrajetPassagers());
        $this->trajet->removePassager($this->user);
        $this->assertNotContains($this->trajet, $this->user->getTrajetPassagers());
    }
}