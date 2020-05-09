<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
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
    private $Aliment;

    /**
     * @ORM\Column(type="float")
     */
    private $QteNecessaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recette", inversedBy="ingredients")
     */
    private $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAliment(): ?string
    {
        return $this->Aliment;
    }

    public function setAliment(string $Aliment): self
    {
        $this->Aliment = $Aliment;

        return $this;
    }

    public function getQteNecessaire(): ?float
    {
        return $this->QteNecessaire;
    }

    public function setQteNecessaire(float $QteNecessaire): self
    {
        $this->QteNecessaire = $QteNecessaire;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
        }

        return $this;
    }
}
