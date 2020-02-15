<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuRepository")
 */
class Lieu
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="lieuArrivee")
     */
    private $trajets;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    public function __construct()
    {
        $this->trajets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getTrajets(): Collection
    {
        return $this->trajets;
    }

    public function addTrajet(Trajet $trajet): self
    {
        if (!$this->trajets->contains($trajet)) {
            $this->trajets[] = $trajet;
            $trajet->setLieuArrivee($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajet): self
    {
        if ($this->trajets->contains($trajet)) {
            $this->trajets->removeElement($trajet);
            // set the owning side to null (unless already changed)
            if ($trajet->getLieuArrivee() === $this) {
                $trajet->setLieuArrivee(null);
            }
        }

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function addDeparttrajet(Trajet $departtrajet): self
    {
        if (!$this->departtrajets->contains($departtrajet)) {
            $this->departtrajets[] = $departtrajet;
            $departtrajet->setLieudepart($this);
        }

        return $this;
    }

    public function removeDeparttrajet(Trajet $departtrajet): self
    {
        if ($this->departtrajets->contains($departtrajet)) {
            $this->departtrajets->removeElement($departtrajet);
            // set the owning side to null (unless already changed)
            if ($departtrajet->getLieudepart() === $this) {
                $departtrajet->setLieudepart(null);
            }
        }

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

}
