<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuArrivee;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private $dateTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $places;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conducteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passagers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart): self
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getLieuArrivee(): ?string
    {
        return $this->lieuArrivee;
    }

    public function setLieuArrivee(string $lieuArrivee): self
    {
        $this->lieuArrivee = $lieuArrivee;

        return $this;
    }

    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getPlaces(): ?string
    {
        return $this->places;
    }

    public function setPlaces(string $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getConducteur(): ?string
    {
        return $this->conducteur;
    }

    public function setConducteur(string $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function getPassagers(): ?string
    {
        return $this->passagers;
    }

    public function setPassagers(string $passagers): self
    {
        $this->passagers = $passagers;

        return $this;
    }
}
