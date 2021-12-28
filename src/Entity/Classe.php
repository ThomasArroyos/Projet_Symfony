<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
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
     */
    private $libelleClasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEleveTotal;

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
}
