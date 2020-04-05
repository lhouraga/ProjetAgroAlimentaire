<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailAlimentRecuRepository")
 */
class DetailAlimentRecu
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
    private $TypeAliment;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeAliment(): ?string
    {
        return $this->TypeAliment;
    }

    public function setTypeAliment(string $TypeAliment): self
    {
        $this->TypeAliment = $TypeAliment;

        return $this;
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
}
