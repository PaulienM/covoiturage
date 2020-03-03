<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trajet;
use App\Entity\Lieu;
use App\Entity\User;


class TrajetTest extends TestCase
{
    protected $trajet;

    public function setUp()
    {
        $this->trajet = new Trajet();
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
        $lieu = new Lieu();
        $this->trajet->setLieudepart($lieu);
        $lieu->addDeparttrajet($this->trajet);
        $this->assertEquals($lieu, $this->trajet->getLieuDepart());
        $this->assertContains($this->trajet, $lieu->getDeparttrajets());
    }

    public function testTrajetLieuArrivee()
    {
        $lieu = new Lieu();
        $this->trajet->setLieuarrivee($lieu);
        $lieu->addArriveetrajet($this->trajet);
        $this->assertEquals($lieu, $this->trajet->getLieuarrivee());
        $this->assertContains($this->trajet, $lieu->getArriveetrajets());
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
}