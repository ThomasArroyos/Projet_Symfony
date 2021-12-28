<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity=App\Entity\Matiere", mappedBy="intervenantAffecte")
     * @ORM\JoinColumn(name="intervenantAffecte", referencedColumnName="idIntervenant")
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

    /**
     * @ORM\Column(type="text")
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="nomMatiere")
     * @ORM\JoinColumn(name="nomMatiere", referencedColumnName="matieresEnseignees")
     */
    private $matieresEnseignees;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateIntervention;

    /**
     * @ORM\Column(type="float")
     */
    private $dureeSemaineInter;

    /**
     * @ORM\Column(type="float")
     */
    private $dureeInterTotale;

    /**
     * @ORM\Column(type="text")
     */
    private $nomMatiere;

    /**
     * @ORM\Column (type="integer")
     * @ORM\OneToMany (targetEntity="App\Entity\Disponibilite", mappedBy="periode")
     */
    private $dispo_perso;

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

    public function getMatieresEnseignees()
    {
        $this->matieresEnseignees = new ArrayCollection();
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(\DateTimeInterface $dateIntervention): self
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    public function getDureeSemaineInter(): ?float
    {
        return $this->dureeSemaineInter;
    }

    public function setDureeSemaineInter(float $dureeSemaineInter): self
    {
        $this->dureeSemaineInter = $dureeSemaineInter;

        return $this;
    }

    public function getDureeInterTotale(): ?float
    {
        return $this->dureeInterTotale;
    }

    public function setDureeInterTotale(float $dureeInterTotale): self
    {
        $this->dureeInterTotale = $dureeInterTotale;

        return $this;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere(string $nomMatiere): self
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    public function getDispoPerso()
    {
        $this->dispo_perso = new ArrayCollection();
    }
}
