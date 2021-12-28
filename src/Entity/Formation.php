<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="nomMatiere")
     */
    private $matieres;

    /**
     * @ORM\Column(type="text")
     * @ORM\OneToMany(targetEntity="App\Entity\Classe", mappedBy="libelleClasse")
     */
    private $classes;

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

    /**
     * @ORM\Column (type="integer")
     * @ORM\OneToMany (targetEntity="App\Entity\Disponibilite", mappedBy="periode")
     */
    private $periode_dispo;

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

    public function getMatieres()
    {
        $this->matieres = new ArrayCollection();
    }

    public function getClasses()
    {
        $this->classes = new ArrayCollection();
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

    public function getPeriodeDispo()
    {
        $this->periode_dispo = new ArrayCollection();
    }
}
