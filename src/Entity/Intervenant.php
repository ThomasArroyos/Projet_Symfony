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
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="intervenantAffecte")
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
     * @ORM\Column (type="date")
     * @ORM\OneToMany (targetEntity="App\Entity\Disponibilite", mappedBy="disponibilite")
     */
    private $disponibilites;

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

    public function getDisponibilites()
    {
        $this->disponibilites = new ArrayCollection();
    }
}
