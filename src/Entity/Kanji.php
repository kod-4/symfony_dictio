<?php

namespace App\Entity;

use App\Repository\KanjiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KanjiRepository::class)
 */
class Kanji
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
    private $caractere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cle;

     /**
     * Many Kanjis have Many Composants.
     * @ORM\ManyToMany(targetEntity="Kanji", mappedBy="aPourComposant")
     */
    private $composant;

    /**
     * Many Composant have many Kanji.
     * @ORM\ManyToMany(targetEntity="Kanji", inversedBy="composant", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="kanji_composant",
     *      joinColumns={@ORM\JoinColumn(name="kanji_id", referencedColumnName="id", nullable=true)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="composant_id", referencedColumnName="id", nullable=true)}
     *      )
     */
    private $aPourComposant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kunyomi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $onyomi;

    /**
     * @ORM\Column(type="integer")
     */
    private $stroke;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sens;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=Vocabulaire::class, mappedBy="kanji")
     */
    private $apparaitDans;

    /**
     * @ORM\ManyToMany(targetEntity=Liste::class, mappedBy="idKanji")
     */
    private $listes;

    public function __construct()
    {
        $this->composant = new ArrayCollection();
        $this->aPourComposant = new ArrayCollection();
        $this->apparaitDans = new ArrayCollection();
        $this->listes = new ArrayCollection();
    }

    public function __toString(){
        return $this->caractere;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCaractere(): ?string
    {
        return $this->caractere;
    }

    public function setCaractere(string $caractere): self
    {
        $this->caractere = $caractere;

        return $this;
    }

    public function getCle(): ?string
    {
        return $this->cle;
    }

    public function setCle(?string $cle): self
    {
        $this->cle = $cle;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getComposant(): Collection
    {
        return $this->composant;
    }

    public function addComposant(self $composant): self
    {
        if (!$this->composant->contains($composant)) {
            $this->composant[] = $composant;
        }

        return $this;
    }

    public function removeComposant(self $composant): self
    {
        $this->composant->removeElement($composant);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAPourComposant(): Collection
    {
        return $this->aPourComposant;
    }

    public function addAPourComposant(self $aPourComposant): self
    {
        if (!$this->aPourComposant->contains($aPourComposant)) {
            $this->aPourComposant[] = $aPourComposant;
            $aPourComposant->addComposant($this);
        }

        return $this;
    }

    public function removeAPourComposant(self $aPourComposant): self
    {
        if ($this->aPourComposant->removeElement($aPourComposant)) {
            $aPourComposant->removeComposant($this);
        }

        return $this;
    }

    public function getKunyomi(): ?string
    {
        return $this->kunyomi;
    }

    public function setKunyomi(?string $kunyomi): self
    {
        $this->kunyomi = $kunyomi;

        return $this;
    }

    public function getOnyomi(): ?string
    {
        return $this->onyomi;
    }

    public function setOnyomi(?string $onyomi): self
    {
        $this->onyomi = $onyomi;

        return $this;
    }

    public function getStroke(): ?int
    {
        return $this->stroke;
    }

    public function setStroke(int $stroke): self
    {
        $this->stroke = $stroke;

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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(?string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection|Vocabulaire[]
     */
    public function getApparaitDans(): Collection
    {
        return $this->apparaitDans;
    }

    public function addApparaitDan(Vocabulaire $apparaitDan): self
    {
        if (!$this->apparaitDans->contains($apparaitDan)) {
            $this->apparaitDans[] = $apparaitDan;
            $apparaitDan->addKanji($this);
        }

        return $this;
    }

    public function removeApparaitDan(Vocabulaire $apparaitDan): self
    {
        if ($this->apparaitDans->removeElement($apparaitDan)) {
            $apparaitDan->removeKanji($this);
        }

        return $this;
    }

    /**
     * @return Collection|Liste[]
     */
    public function getListes(): Collection
    {
        return $this->listes;
    }

    public function addListe(Liste $liste): self
    {
        if (!$this->listes->contains($liste)) {
            $this->listes[] = $liste;
            $liste->addIdKanji($this);
        }

        return $this;
    }

    public function removeListe(Liste $liste): self
    {
        if ($this->listes->removeElement($liste)) {
            $liste->removeIdKanji($this);
        }

        return $this;
    }
}
