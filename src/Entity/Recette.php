<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository")
 */
class Recette
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
    private $NomRecette;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRecette", inversedBy="recette")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeRecette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->NomRecette;
    }

    public function setNomRecette(string $NomRecette): self
    {
        $this->NomRecette = $NomRecette;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTypeRecette(): ?TypeRecette
    {
        return $this->typeRecette;
    }

    public function setTypeRecette(?TypeRecette $typeRecette): self
    {
        $this->typeRecette = $typeRecette;

        return $this;
    }
}
