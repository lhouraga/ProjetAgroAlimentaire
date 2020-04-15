<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeAlimentRepository")
 */
class TypeAliment
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
    private $Type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailLotRecu", mappedBy="typeAliment")
     */
    private $detAliment;

    public function __construct()
    {
        $this->detAliment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|DetailLotRecu[]
     */
    public function getDetAliment(): Collection
    {
        return $this->detAliment;
    }

    public function addDetAliment(DetailLotRecu $detAliment): self
    {
        if (!$this->detAliment->contains($detAliment)) {
            $this->detAliment[] = $detAliment;
            $detAliment->setTypeAliment($this);
        }

        return $this;
    }

    public function removeDetAliment(DetailLotRecu $detAliment): self
    {
        if ($this->detAliment->contains($detAliment)) {
            $this->detAliment->removeElement($detAliment);
            // set the owning side to null (unless already changed)
            if ($detAliment->getTypeAliment() === $this) {
                $detAliment->setTypeAliment(null);
            }
        }

        return $this;
    }

}
