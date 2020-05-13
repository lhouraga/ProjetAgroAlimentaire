<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailLotRecuRepository")
 */
class DetailLotRecu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $NomAliment;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixUnitaire;

    /**
     * @ORM\Column(type="date")
     */
    private $DatePeremption;

    /**
     * @ORM\Column(type="float")
     */
    private $QteRecu;

    /**
     * @ORM\Column(type="float")
     */
    private $QteUtilise;

    /**
     * @ORM\Column(type="float")
     */
    private $QteDispo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lot", inversedBy="DetailAliment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeAliment", inversedBy="detAliment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeAliment;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PlatPrepare", mappedBy="AlimentsUtilise")
     */
    private $platPrepares;

    public function __construct()
    {
        $this->platPrepares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getNomAliment(): ?string
    {
        return $this->NomAliment;
    }

    public function setNomAliment(string $NomAliment): self
    {
        $this->NomAliment = $NomAliment;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->PrixUnitaire;
    }

    public function setPrixUnitaire(float $PrixUnitaire): self
    {
        $this->PrixUnitaire = $PrixUnitaire;

        return $this;
    }

    public function getDatePeremption(): ?\DateTimeInterface
    {
        return $this->DatePeremption;
    }

    public function setDatePeremption(\DateTimeInterface $DatePeremption): self
    {
        $this->DatePeremption = $DatePeremption;

        return $this;
    }

    public function getQteRecu(): ?float
    {
        return $this->QteRecu;
    }

    public function setQteRecu(float $QteRecu): self
    {
        $this->QteRecu = $QteRecu;

        return $this;
    }

    public function getQteUtilise(): ?float
    {
        return $this->QteUtilise;
    }

    public function setQteUtilise(float $QteUtilise): self
    {
        $this->QteUtilise = $QteUtilise;

        return $this;
    }

    public function getQteDispo(): ?float
    {
        return $this->QteDispo;
    }

    public function setQteDispo(float $QteDispo): self
    {
        $this->QteDispo = $QteDispo;

        return $this;
    }

    public function getLot(): ?Lot
    {
        return $this->lot;
    }

    public function setLot(?Lot $lot): self
    {
        $this->lot = $lot;

        return $this;
    }

    public function getTypeAliment(): ?TypeAliment
    {
        return $this->typeAliment;
    }

    public function setTypeAliment(?TypeAliment $typeAliment): self
    {
        $this->typeAliment = $typeAliment;

        return $this;
    }

    /**
     * @return Collection|PlatPrepare[]
     */
    public function getPlatPrepares(): Collection
    {
        return $this->platPrepares;
    }

    public function addPlatPrepare(PlatPrepare $platPrepare): self
    {
        if (!$this->platPrepares->contains($platPrepare)) {
            $this->platPrepares[] = $platPrepare;
            $platPrepare->addAlimentsUtilise($this);
        }

        return $this;
    }

    public function removePlatPrepare(PlatPrepare $platPrepare): self
    {
        if ($this->platPrepares->contains($platPrepare)) {
            $this->platPrepares->removeElement($platPrepare);
            $platPrepare->removeAlimentUtilise($this);
        }

        return $this;
    }
}
