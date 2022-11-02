<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomAgence = null;

    #[ORM\Column(length: 255)]
    private ?string $AdressAgence = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $commune = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->NomAgence;
    }

    public function setNomAgence(string $NomAgence): self
    {
        $this->NomAgence = $NomAgence;

        return $this;
    }

    public function getAdressAgence(): ?string
    {
        return $this->AdressAgence;
    }

    public function setAdressAgence(string $AdressAgence): self
    {
        $this->AdressAgence = $AdressAgence;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(?string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }
}
