<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RechercheRecetteNomRepository")
 */
class RechercheRecetteNom
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $NomRecette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->NomRecette;
    }

    public function setNomRecette(?string $NomRecette): self
    {
        $this->NomRecette = $NomRecette;

        return $this;
    }
}
