<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\lieu")
     */
    private $lieuDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\lieu", inversedBy="trajets")
     */
    private $lieuArrivee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="trajets")
     */
    private $conducteur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user", inversedBy="trajets")
     */
    private $passagers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $places;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    public function __construct()
    {
        $this->passagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuDepart(): ?lieu
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(?lieu $lieuDepart): self
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getLieuArrivee(): ?lieu
    {
        return $this->lieuArrivee;
    }

    public function setLieuArrivee(?lieu $lieuArrivee): self
    {
        $this->lieuArrivee = $lieuArrivee;

        return $this;
    }

    public function getConducteur(): ?user
    {
        return $this->conducteur;
    }

    public function setConducteur(?user $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getPassagers(): Collection
    {
        return $this->passagers;
    }

    public function addPassager(user $passager): self
    {
        if (!$this->passagers->contains($passager)) {
            $this->passagers[] = $passager;
        }

        return $this;
    }

    public function removePassager(user $passager): self
    {
        if ($this->passagers->contains($passager)) {
            $this->passagers->removeElement($passager);
        }

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

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
}
