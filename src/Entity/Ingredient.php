<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer")
     */
    private $IdRecette;

    /**
     * @ORM\Column(type="float")
     */
    private $QteNecessaire;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixUnitaire;

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

    public function getIdRecette(): ?int
    {
        return $this->IdRecette;
    }

    public function setIdRecette(int $IdRecette): self
    {
        $this->IdRecette = $IdRecette;

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

    public function getPrixUnitaire(): ?float
    {
        return $this->PrixUnitaire;
    }

    public function setPrixUnitaire(float $PrixUnitaire): self
    {
        $this->PrixUnitaire = $PrixUnitaire;

        return $this;
    }
}
