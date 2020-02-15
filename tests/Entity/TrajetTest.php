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
}