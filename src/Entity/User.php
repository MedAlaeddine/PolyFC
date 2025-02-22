<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="iduser")
     */
    private $idEtudiant;

    /**
     * @ORM\OneToMany(targetEntity=UserCertif::class, mappedBy="user")
     */
    private $userCertifs;

    public function __construct()
    {
        $this->idEtudiant = new ArrayCollection();
        $this->userCertifs = new ArrayCollection();
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getUsername()
    {
        return $this->login;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getIdEtudiant(): Collection
    {
        return $this->idEtudiant;
    }

    public function addIdEtudiant(Etudiant $idEtudiant): self
    {
        if (!$this->idEtudiant->contains($idEtudiant)) {
            $this->idEtudiant[] = $idEtudiant;
            $idEtudiant->setIduser($this);
        }

        return $this;
    }

    public function removeIdEtudiant(Etudiant $idEtudiant): self
    {
        if ($this->idEtudiant->removeElement($idEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($idEtudiant->getIduser() === $this) {
                $idEtudiant->setIduser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserCertif>
     */
    public function getUserCertifs(): Collection
    {
        return $this->userCertifs;
    }

    public function addUserCertif(UserCertif $userCertif): self
    {
        if (!$this->userCertifs->contains($userCertif)) {
            $this->userCertifs[] = $userCertif;
            $userCertif->setUser($this);
        }

        return $this;
    }

    public function removeUserCertif(UserCertif $userCertif): self
    {
        if ($this->userCertifs->removeElement($userCertif)) {
            // set the owning side to null (unless already changed)
            if ($userCertif->getUser() === $this) {
                $userCertif->setUser(null);
            }
        }

        return $this;
    }
    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
}
