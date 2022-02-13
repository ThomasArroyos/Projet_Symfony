<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

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
     * @ORM\Column(name="date_debut_formation", type="datetime")
     */
    private $dateDebutFormation;

    /**
     * @ORM\Column(name="date_fin_formation", type="datetime")
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

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="id")
     */
    private $userId;

    public function getId(): int
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

    public function getDateDebutFormation(): ?Date
    {
        return $this->dateDebutFormation;
    }

    public function setDateDebutFormation(Date $dateDebutFormation): self
    {
        $this->dateDebutFormation = $dateDebutFormation;

        return $this;
    }

    public function getDateFinFormation(): ?Date
    {
        return $this->dateFinFormation;
    }

    public function setDateFinFormation(Date $dateFinFormation): self
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

    public function getUserId()
    {
        $this->userId = new ArrayCollection();
    }
}
