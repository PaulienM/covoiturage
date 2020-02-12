<?php


namespace App\Tests\Entity;

use Monolog\Test\TestCase;
use App\Entity\Trajet;


class TrajetTest extends TestCase
{
    protected $trajet;
    public function setUp() {
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

    public function testTrajetDateTime() {
        $date = new \DateTime();

        $this->trajet->setDateTime($date);
        $this->assertEquals($date, $this->trajet->getDateTime());
    }

    public function testLieuDepart() {
        $lieu = new Lieu();

        $this->trajet->setLieuDepart($lieu);
        $this->assertEquals($lieu, $this->trajet->getLieuDepart());
    }

}