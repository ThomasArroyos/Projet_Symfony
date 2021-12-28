<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idGroupe;

    /**
     * @ORM\Column(type="text")
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="libelleClasse")
     * @ORM\JoinColumn(name="groupe_libelle", referencedColumnName="libelleGroupe")
     */
    private $libelleGroupe;

    /**
     * @ORM\Column(type="text")
     * @ORM\OneToOne (targetEntity="App\Entity\Classe", inversedBy="libelleClasse")
     */
    private $libelleClasse;

    /**
     * @ORM\Column(type="text")
     */
    private $specialite;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEleveGroupe;

    public function getIdGroupe(): ?int
    {
        return $this->idGroupe;
    }

    public function getLibelleGroupe(): ?string
    {
        return $this->libelleGroupe;
    }

    public function setLibelleGroupe(string $libelleGroupe): self
    {
        $this->libelleGroupe = $libelleGroupe;

        return $this;
    }

    public function getLibelleClasse(): ?string
    {
        return $this->libelleClasse;
    }

    public function setLibelleClasse(string $libelleClasse): self
    {
        $this->libelleClasse = $libelleClasse;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getNbEleveGroupe(): ?int
    {
        return $this->nbEleveGroupe;
    }

    public function setNbEleveGroupe(int $nbEleveGroupe): self
    {
        $this->nbEleveGroupe = $nbEleveGroupe;

        return $this;
    }
}
