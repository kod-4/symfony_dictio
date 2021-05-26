<?php

namespace App\Entity;

use App\Repository\CompteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteurRepository::class)
 */
class Compteur
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
    private $symbole;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sens;

    /**
     * @ORM\Column(type="text")
     */
    private $tableau;

    /**
     * @ORM\ManyToMany(targetEntity=Vocabulaire::class, mappedBy="Compteur")
     */
    private $CompteLeMot;

    public function __construct()
    {
        $this->CompteLeMot = new ArrayCollection();
    }

    public function __toString(){
        return $this->symbole;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(string $symbole): self
    {
        $this->symbole = $symbole;

        return $this;
    }

    public function getSens(): ?string
    {
        return $this->sens;
    }

    public function setSens(string $sens): self
    {
        $this->sens = $sens;

        return $this;
    }

    public function getTableau(): ?string
    {
        return $this->tableau;
    }

    public function setTableau(string $tableau): self
    {
        $this->tableau = $tableau;

        return $this;
    }

    /**
     * @return Collection|Vocabulaire[]
     */
    public function getCompteLeMot(): Collection
    {
        return $this->CompteLeMot;
    }

    public function addCompteLeMot(Vocabulaire $compteLeMot): self
    {
        if (!$this->CompteLeMot->contains($compteLeMot)) {
            $this->CompteLeMot[] = $compteLeMot;
            $compteLeMot->addCompteur($this);
        }

        return $this;
    }

    public function removeCompteLeMot(Vocabulaire $compteLeMot): self
    {
        if ($this->CompteLeMot->removeElement($compteLeMot)) {
            $compteLeMot->removeCompteur($this);
        }

        return $this;
    }
}