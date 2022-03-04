<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_fin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $journee_entiere;

    /**
     * @ORM\Column(type="boolean")
     */
    private $chevauchable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $modifiable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accepte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $en_fond;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reccurent;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $date_debut_recurrence;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $date_fin_recurrence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jours_recurrence;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="evenements")
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity=Intervenant::class, inversedBy="evenements")
     */
    private $intervenant;

    /**
     * @ORM\ManyToOne(targetEntity=Specialite::class, inversedBy="evenements")
     */
    private $specialite;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="evenements")
     */
    private $formation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getJourneeEntiere(): ?bool
    {
        return $this->journee_entiere;
    }

    public function setJourneeEntiere(bool $journee_entiere): self
    {
        $this->journee_entiere = $journee_entiere;

        return $this;
    }

    public function getChevauchable(): ?bool
    {
        return $this->chevauchable;
    }

    public function setChevauchable(bool $chevauchable): self
    {
        $this->chevauchable = $chevauchable;

        return $this;
    }

    public function getModifiable(): ?bool
    {
        return $this->modifiable;
    }

    public function setModifiable(bool $modifiable): self
    {
        $this->modifiable = $modifiable;

        return $this;
    }

    public function getAccepte(): ?bool
    {
        return $this->accepte;
    }

    public function setAccepte(bool $accepte): self
    {
        $this->accepte = $accepte;

        return $this;
    }

    public function getEnFond(): ?string
    {
        return $this->en_fond;
    }

    public function setEnFond(string $en_fond): self
    {
        $this->en_fond = $en_fond;

        return $this;
    }

    public function getReccurent(): ?bool
    {
        return $this->reccurent;
    }

    public function setReccurent(bool $reccurent): self
    {
        $this->reccurent = $reccurent;

        return $this;
    }

    public function getDateDebutRecurrence(): ?\DateTimeInterface
    {
        return $this->date_debut_recurrence;
    }

    public function setDateDebutRecurrence(?\DateTimeInterface $date_debut_recurrence): self
    {
        $this->date_debut_recurrence = $date_debut_recurrence;

        return $this;
    }

    public function getDateFinRecurrence(): ?\DateTimeInterface
    {
        return $this->date_fin_recurrence;
    }

    public function setDateFinRecurrence(?\DateTimeInterface $date_fin_recurrence): self
    {
        $this->date_fin_recurrence = $date_fin_recurrence;

        return $this;
    }

    public function getJoursRecurrence(): ?string
    {
        return $this->jours_recurrence;
    }

    public function setJoursRecurrence(?string $jours_recurrence): self
    {
        $this->jours_recurrence = $jours_recurrence;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function addMatiere(?Matiere $matiere): self
    {
        dd("test");
        return $this;
    }

    public function getIntervenant(): ?Intervenant
    {
        return $this->intervenant;
    }

    public function setIntervenant(?Intervenant $intervenant): self
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(?Specialite $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }
}
