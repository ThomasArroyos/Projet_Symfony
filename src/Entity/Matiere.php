<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @ORM\ManyToOne (targetEntity="App\Entity\Formation", inversedBy="matieres")
     * @ORM\JoinColumn (name="matieres", referencedColumnName="nomMatiere")
     */
    private $nomMatiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeTotale;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Intervenant", inversedBy="idIntervenant")
     */
    private $intervenantAffecte;

    /**
     * @ORM\Column(type="text")
     * @ORM\OneToMany(targetEntity="App\Entity\Classe", mappedBy="idClasse")
     * @ORM\JoinColumn(name="classeId", referencedColumnName="idClasse")
     */
    private $classeId;

    public function getId(): int
    {
        return $this->id;
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

    public function getDureeTotale(): ?int
    {
        return $this->dureeTotale;
    }

    public function setDureeTotale(int $dureeTotale): self
    {
        $this->dureeTotale = $dureeTotale;

        return $this;
    }

    public function getIntervenantAffecte(): ?int
    {
        return $this->intervenantAffecte;
    }

    public function setIntervenantAffecte(int $intervenantAffecte): self
    {
        $this->intervenantAffecte = $intervenantAffecte;

        return $this;
    }

    public function getClasseId()
    {
        $this->classeId = new ArrayCollection();
    }
}
