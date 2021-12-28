<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nomFormation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebutFormation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFinFormation;

    /**
     * @ORM\Column(type="text")
     */
    private $matieres;

    /**
     * @ORM\Column(type="float")
     */
    private $dureeMatiere;

    /**
     * @ORM\Column(type="date")
     */
    private $periodesEntreprise;

    /**
     * @ORM\Column(type="date")
     */
    private $periodesCours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormation(): ?string
    {
        return $this->nomFormation;
    }

    public function setNomFormation(string $nomFormation): self
    {
        $this->nomFormation = $nomFormation;

        return $this;
    }

    public function getDateDebutFormation(): ?\DateTimeInterface
    {
        return $this->dateDebutFormation;
    }

    public function setDateDebutFormation(\DateTimeInterface $dateDebutFormation): self
    {
        $this->dateDebutFormation = $dateDebutFormation;

        return $this;
    }

    public function getDateFinFormation(): ?\DateTimeInterface
    {
        return $this->dateFinFormation;
    }

    public function setDateFinFormation(\DateTimeInterface $dateFinFormation): self
    {
        $this->dateFinFormation = $dateFinFormation;

        return $this;
    }

    public function getMatieres(): ?string
    {
        return $this->matieres;
    }

    public function setMatieres(string $matieres): self
    {
        $this->matieres = $matieres;

        return $this;
    }

    public function getDureeMatiere(): ?float
    {
        return $this->dureeMatiere;
    }

    public function setDureeMatiere(float $dureeMatiere): self
    {
        $this->dureeMatiere = $dureeMatiere;

        return $this;
    }

    public function getPeriodesEntreprise(): ?\DateTimeInterface
    {
        return $this->periodesEntreprise;
    }

    public function setPeriodesEntreprise(\DateTimeInterface $periodesEntreprise): self
    {
        $this->periodesEntreprise = $periodesEntreprise;

        return $this;
    }

    public function getPeriodesCours(): ?\DateTimeInterface
    {
        return $this->periodesCours;
    }

    public function setPeriodesCours(\DateTimeInterface $periodesCours): self
    {
        $this->periodesCours = $periodesCours;

        return $this;
    }
}
