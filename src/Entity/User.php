<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="user")
     */
    private $trajetConducteurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trajet", mappedBy="passagers")
     */
    private $trajetPassagers;

    public function __construct()
    {
        $this->trajetConducteurs = new ArrayCollection();
        $this->trajetPassagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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
    public function getTrajetConducteurs(): Collection
    {
        return $this->trajetConducteurs;
    }

    public function addTrajetConducteur(Trajet $trajetConducteurs): self
    {
        if (!$this->trajetConducteurs->contains($trajetConducteurs)) {
            $this->trajetConducteurs[] = $trajetConducteurs;
            $trajetConducteurs->setConducteur($this);
        }

        return $this;
    }

    public function removeTrajetConducteur(Trajet $trajetConducteurs): self
    {
        if ($this->trajetConducteurs->contains($trajetConducteurs)) {
            $this->trajetConducteurs->removeElement($trajetConducteurs);
            // set the owning side to null (unless already changed)
            if ($trajetConducteurs->getConducteur() === $this) {
                $trajetConducteurs->setConducteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getTrajetPassagers(): Collection
    {
        return $this->trajetPassagers;
    }

    public function addTrajetPassager(Trajet $trajetPassagers): self
    {
        if (!$this->trajetPassagers->contains($trajetPassagers)) {
            $this->trajetPassagers[] = $trajetPassagers;
        }
        if (!$trajetPassagers->getPassagers()->contains($this)) {
            $trajetPassagers->addPassager($this);
        }

        return $this;
    }

    public function removeTrajetPassager(Trajet $trajetPassagers): self
    {
        if ($this->trajetPassagers->contains($trajetPassagers)) {
            $this->trajetPassagers->removeElement($trajetPassagers);

            if ($trajetPassagers->getPassagers()->contains($this)) {
                $trajetPassagers->removePassager($this);
            }
        }

        return $this;
    }
}
