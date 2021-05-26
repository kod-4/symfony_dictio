<?php

namespace App\Entity;

use App\Repository\VocabulaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VocabulaireRepository::class)
 */
class Vocabulaire
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
    private $mot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kana;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $romaji;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sens;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contexte;

    /**
     * @ORM\ManyToMany(targetEntity=Kanji::class, inversedBy="apparaitDans")
     */
    private $kanji;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jlpt;

    /**
     * @ORM\ManyToMany(targetEntity=Compteur::class, inversedBy="CompteLeMot")
     */
    private $Compteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accent;

    /**
     * @ORM\ManyToMany(targetEntity="Vocabulaire", mappedBy="synonymeAvec")
     */
    private $synonyme;

    /**
     * @ORM\ManyToMany(targetEntity="Vocabulaire", inversedBy="synonyme")
     * @ORM\JoinTable(name="vocabulaire_synonyme",
     *      joinColumns={@ORM\JoinColumn(name="vocabulaire_id", referencedColumnName="id", nullable=true)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="synonyme_id", referencedColumnName="id", nullable=true)}
     * )
     */
    private $synonymeAvec;

    /**
     * @ORM\ManyToMany(targetEntity="Vocabulaire", mappedBy="antonymeDe")
     */
    private $antonyme;

    /**
     * @ORM\ManyToMany(targetEntity="Vocabulaire", inversedBy="antonyme")
     * @ORM\JoinTable(name="vocabulaire_antonyme",
     *      joinColumns={@ORM\JoinColumn(name="vocabulaire_id", referencedColumnName="id", nullable=true)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="antonyme_id", referencedColumnName="id", nullable=true)}
     * )
     */
    private $antonymeDe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $classe;

    /**
     * @ORM\ManyToMany(targetEntity=Liste::class, mappedBy="idMot")
     */
    private $listes;

    public function __construct()
    {
        $this->kanji = new ArrayCollection();
        $this->Compteur = new ArrayCollection();
        $this->synonyme = new ArrayCollection();
        $this->synonymeAvec = new ArrayCollection();
        $this->antonyme = new ArrayCollection();
        $this->antonymeDe = new ArrayCollection();
        $this->listes = new ArrayCollection();
    }

    public function __toString(){
        return $this->mot;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMot(): ?string
    {
        return $this->mot;
    }

    public function setMot(string $mot): self
    {
        $this->mot = $mot;

        return $this;
    }

    public function getKana(): ?string
    {
        return $this->kana;
    }

    public function setKana(string $kana): self
    {
        $this->kana = $kana;

        return $this;
    }

    public function getRomaji(): ?string
    {
        return $this->romaji;
    }

    public function setRomaji(string $romaji): self
    {
        $this->romaji = $romaji;

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

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(?string $contexte): self
    {
        $this->contexte = $contexte;

        return $this;
    }

    /**
     * @return Collection|Kanji[]
     */
    public function getKanji(): Collection
    {
        return $this->kanji;
    }

    public function addKanji(Kanji $kanji): self
    {
        if (!$this->kanji->contains($kanji)) {
            $this->kanji[] = $kanji;
        }

        return $this;
    }

    public function removeKanji(Kanji $kanji): self
    {
        $this->kanji->removeElement($kanji);

        return $this;
    }

    public function getJlpt(): ?string
    {
        return $this->jlpt;
    }

    public function setJlpt(?string $jlpt): self
    {
        $this->jlpt = $jlpt;

        return $this;
    }

    /**
     * @return Collection|Compteur[]
     */
    public function getCompteur(): Collection
    {
        return $this->Compteur;
    }

    public function addCompteur(Compteur $compteur): self
    {
        if (!$this->Compteur->contains($compteur)) {
            $this->Compteur[] = $compteur;
        }

        return $this;
    }

    public function removeCompteur(Compteur $compteur): self
    {
        $this->Compteur->removeElement($compteur);

        return $this;
    }

    public function getAccent(): ?string
    {
        return $this->accent;
    }

    public function setAccent(?string $accent): self
    {
        $this->accent = $accent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSynonyme(): Collection
    {
        return $this->synonyme;
    }

    public function addSynonyme(self $synonyme): self
    {
        if (!$this->synonyme->contains($synonyme)) {
            $this->synonyme[] = $synonyme;
        }

        return $this;
    }

    public function removeSynonyme(self $synonyme): self
    {
        $this->synonyme->removeElement($synonyme);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSynonymeAvec(): Collection
    {
        return $this->synonymeAvec;
    }

    public function addSynonymeAvec(self $synonymeAvec): self
    {
        if (!$this->synonymeAvec->contains($synonymeAvec)) {
            $this->synonymeAvec[] = $synonymeAvec;
            $synonymeAvec->addSynonyme($this);
        }

        return $this;
    }

    public function removeSynonymeAvec(self $synonymeAvec): self
    {
        if ($this->synonymeAvec->removeElement($synonymeAvec)) {
            $synonymeAvec->removeSynonyme($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAntonyme(): Collection
    {
        return $this->antonyme;
    }

    public function addAntonyme(self $antonyme): self
    {
        if (!$this->antonyme->contains($antonyme)) {
            $this->antonyme[] = $antonyme;
        }

        return $this;
    }

    public function removeAntonyme(self $antonyme): self
    {
        $this->antonyme->removeElement($antonyme);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAntonymeDe(): Collection
    {
        return $this->antonymeDe;
    }

    public function addAntonymeDe(self $antonymeDe): self
    {
        if (!$this->antonymeDe->contains($antonymeDe)) {
            $this->antonymeDe[] = $antonymeDe;
            $antonymeDe->addAntonyme($this);
        }

        return $this;
    }

    public function removeAntonymeDe(self $antonymeDe): self
    {
        if ($this->antonymeDe->removeElement($antonymeDe)) {
            $antonymeDe->removeAntonyme($this);
        }

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(?string $classe): self
    {
        $this->classe = $classe;

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
            $liste->addIdMot($this);
        }

        return $this;
    }

    public function removeListe(Liste $liste): self
    {
        if ($this->listes->removeElement($liste)) {
            $liste->removeIdMot($this);
        }

        return $this;
    }
}