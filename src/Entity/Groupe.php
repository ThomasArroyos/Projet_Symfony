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
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="groupeId")
     * @ORM\JoinColumn(name="groupeId", referencedColumnName="idGroupe")
     */
    private $idGroupe;

    /**
     * @ORM\Column(type="text")
     */
    private $specialite;

    public function getIdGroupe(): ?int
    {
        return $this->idGroupe;
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
}
