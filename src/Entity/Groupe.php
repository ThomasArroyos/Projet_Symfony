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
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $specialite;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="groupes")
     * @ORM\JoinColumn(name="classeId")
     */
    private $classeId;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite()
    {
        return $this->specialite;
    }

    public function setSpecialite($specialite): void
    {
        $this->specialite = $specialite;
    }

    public function getClasseId(): ?Classe
    {
        return $this->classeId;
    }

    public function setClasseId(?Classe $classeId): self
    {
        $this->classeId = $classeId;

        return $this;
    }
}
