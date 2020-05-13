<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatPrepareRepository")
 */
class PlatPrepare
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $NomPlat;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbrePlat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DatePrepare;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixTotal;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DetailLotRecu", inversedBy="platPrepares")
     */
    private $AlimentsUtilise;

    public function __construct()
    {
        $this->AlimentsUtilise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlat(): ?string
    {
        return $this->NomPlat;
    }

    public function setNomPlat(string $NomPlat): self
    {
        $this->NomPlat = $NomPlat;

        return $this;
    }

    public function getNbrePlat(): ?int
    {
        return $this->NbrePlat;
    }

    public function setNbrePlat(int $NbrePlat): self
    {
        $this->NbrePlat = $NbrePlat;

        return $this;
    }

    public function getDatePrepare(): ?\DateTimeInterface
    {
        return $this->DatePrepare;
    }

    public function setDatePrepare(\DateTimeInterface $DatePrepare): self
    {
        $this->DatePrepare = $DatePrepare;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(?float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * @return Collection|DetailLotRecu[]
     */
    public function getAlimentsUtilise(): Collection
    {
        return $this->AlimentsUtilise;
    }

    public function addAlimentsUtilise(DetailLotRecu $alimentsUtilise): self
    {
        if (!$this->AlimentsUtilise->contains($alimentsUtilise)) {
            $this->AlimentsUtilise[] = $alimentsUtilise;
        }

        return $this;
    }

    public function removeAlimentsUtilise(DetailLotRecu $alimentsUtilise): self
    {
        if ($this->AlimentsUtilise->contains($alimentsUtilise)) {
            $this->AlimentsUtilise->removeElement($alimentsUtilise);
        }

        return $this;
    }
}
