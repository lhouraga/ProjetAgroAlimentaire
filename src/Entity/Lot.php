<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LotRepository")
 */
class Lot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateReception;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="lots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailAlimentRecu", mappedBy="lot")
     */
    private $DetailAliment;

    public function __construct()
    {
        $this->DetailAliment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->DateReception;
    }

    public function setDateReception(\DateTimeInterface $DateReception): self
    {
        $this->DateReception = $DateReception;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection|DetailAlimentRecu[]
     */
    public function getDetailAliment(): Collection
    {
        return $this->DetailAliment;
    }

    public function addDetailAliment(DetailAlimentRecu $detailAliment): self
    {
        if (!$this->DetailAliment->contains($detailAliment)) {
            $this->DetailAliment[] = $detailAliment;
            $detailAliment->setLot($this);
        }

        return $this;
    }

    public function removeDetailAliment(DetailAlimentRecu $detailAliment): self
    {
        if ($this->DetailAliment->contains($detailAliment)) {
            $this->DetailAliment->removeElement($detailAliment);
            // set the owning side to null (unless already changed)
            if ($detailAliment->getLot() === $this) {
                $detailAliment->setLot(null);
            }
        }

        return $this;
    }
}
