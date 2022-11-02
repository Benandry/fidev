<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomCommune = null;

    #[ORM\Column(length: 255)]
    private ?string $CodeCommune = null;


    #[ORM\OneToMany(mappedBy: 'Idadresse', targetEntity: Individuelclient::class)]
    private Collection $Idadresse;

    public function __construct()
    {
        $this->Codecomm = new ArrayCollection();
        $this->Idadresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCommune(): ?string
    {
        return $this->NomCommune;
    }

    public function setNomCommune(string $NomCommune): self
    {
        $this->NomCommune = $NomCommune;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->CodeCommune;
    }

    public function setCodeCommune(string $CodeCommune): self
    {
        $this->CodeCommune = $CodeCommune;

        return $this;
    }

        public function __toString()
    {
        return (string) $this->getId();
    }

        /**
         * @return Collection<int, Individuelclient>
         */
        public function getIdadresse(): Collection
        {
            return $this->Idadresse;
        }

        public function addIdadresse(Individuelclient $idadresse): self
        {
            if (!$this->Idadresse->contains($idadresse)) {
                $this->Idadresse[] = $idadresse;
                $idadresse->setIdadresse($this);
            }

            return $this;
        }

        public function removeIdadresse(Individuelclient $idadresse): self
        {
            if ($this->Idadresse->removeElement($idadresse)) {
                // set the owning side to null (unless already changed)
                if ($idadresse->getIdadresse() === $this) {
                    $idadresse->setIdadresse(null);
                }
            }

            return $this;
        }

}
