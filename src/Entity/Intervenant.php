<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntervenantRepository::class)
 */
class Intervenant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idIntervenant;

    /**
     * @ORM\Column(type="text")
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $prenom;

    /**
     * @ORM\Column(type="float")
     */
    private $heuresTravaillees;

    public function getIdIntervenant(): ?int
    {
        return $this->idIntervenant;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getHeuresTravaillees(): ?float
    {
        return $this->heuresTravaillees;
    }

    public function setHeuresTravaillees(float $heuresTravaillees): self
    {
        $this->heuresTravaillees = $heuresTravaillees;

        return $this;
    }
}
