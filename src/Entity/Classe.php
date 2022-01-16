<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idClasse;

    /**
     * @ORM\Column(type="text")
     * @ORM\OneToOne(targetEntity="App\Entity\Groupe", mappedBy="libelleClasse")
     * @ORM\ManyToOne(targetEntity="App\Entity\Formation", inversedBy="classes")
     * @ORM\JoinColumn (name="libelleClasse", referencedColumnName="libelleClasse")
     * @ORM\JoinColumn (name="classes", referencedColumnName="libelleClasse")
     */
    private $libelleClasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEleveTotal;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity=App\Entity\Groupe", mappedBy="idGroupe")
     */
    private $groupeId;

    public function getIdClasse(): ?int
    {
        return $this->idClasse;
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

    public function getNbEleveTotal(): ?int
    {
        return $this->nbEleveTotal;
    }

    public function setNbEleveTotal(int $nbEleveTotal): self
    {
        $this->nbEleveTotal = $nbEleveTotal;

        return $this;
    }

    public function getGroupeId()
    {
        $this->groupeId = new ArrayCollection();
    }
}
