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
    private $dureeMatieres;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\Disponibilite", mappedBy="periode")
     */
    private $periodes;

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

    public function getDureeMatieres(): ?float
    {
        return $this->dureeMatieres;
    }

    public function setDureeMatiere(float $dureeMatieres): self
    {
        $this->dureeMatieres = $dureeMatieres;

        return $this;
    }

    public function getPeriodes()
    {
        $this->periodes = new ArrayCollection();
    }
}
