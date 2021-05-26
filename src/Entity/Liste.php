<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
class Liste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="liste", cascade={"persist", "remove"})
     */
    private $idUser;

    /**
     * @ORM\ManyToMany(targetEntity=Vocabulaire::class, inversedBy="listes")
     */
    private $idMot;

    /**
     * @ORM\ManyToMany(targetEntity=Kanji::class, inversedBy="listes")
     */
    private $idKanji;

    public function __construct()
    {
        $this->idMot = new ArrayCollection();
        $this->idKanji = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Collection|Vocabulaire[]
     */
    public function getIdMot(): Collection
    {
        return $this->idMot;
    }

    public function addIdMot(Vocabulaire $idMot): self
    {
        if (!$this->idMot->contains($idMot)) {
            $this->idMot[] = $idMot;
        }

        return $this;
    }

    public function removeIdMot(Vocabulaire $idMot): self
    {
        $this->idMot->removeElement($idMot);

        return $this;
    }

    /**
     * @return Collection|Kanji[]
     */
    public function getIdKanji(): Collection
    {
        return $this->idKanji;
    }

    public function addIdKanji(Kanji $idKanji): self
    {
        if (!$this->idKanji->contains($idKanji)) {
            $this->idKanji[] = $idKanji;
        }

        return $this;
    }

    public function removeIdKanji(Kanji $idKanji): self
    {
        $this->idKanji->removeElement($idKanji);

        return $this;
    }
}
