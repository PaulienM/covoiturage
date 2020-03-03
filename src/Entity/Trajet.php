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
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="departTrajets")
     */
    private $lieuDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="arriveeTrajets")
     */
    private $lieuArrivee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="conducteurtrajets")
     */
    private $conducteur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="passagertrajets")
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
        if ($lieuDepart instanceof Lieu) {
            $lieuDepart->addDepartTrajet($this);
        }

        return $this;
    }

    public function getLieuArrivee(): ?lieu
    {
        return $this->lieuArrivee;
    }

    public function setLieuArrivee(?lieu $lieuArrivee): self
    {
        $this->lieuArrivee = $lieuArrivee;
        if ($lieuArrivee instanceof Lieu) {
            $lieuArrivee->addArriveeTrajet($this);
        }

        return $this;
    }

    public function getConducteur(): ?user
    {
        return $this->conducteur;
    }

    public function setConducteur(?user $conducteur): self
    {
        $this->conducteur = $conducteur;
        if ($conducteur instanceof User && ! $conducteur->getTrajetConducteurs()->contains($this)
        ) {
            $conducteur->addTrajetConducteur($this);
        }

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
        if (!$passager->getTrajetPassagers()->contains($this)) {
            $passager->addTrajetPassager($this);
        }

        return $this;
    }

    public function removePassager(user $passager): self
    {
        if ($this->passagers->contains($passager)) {
            $this->passagers->removeElement($passager);

            if ($passager->getTrajetPassagers()->contains($this)) {
                $passager->removeTrajetPassager($this);
            }
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
