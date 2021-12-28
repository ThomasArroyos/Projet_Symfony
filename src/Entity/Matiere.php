<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
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
    private $idMatiere;

    /**
     * @ORM\Column(type="text")
     */
    private $nomMatiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeTotale;

    /**
     * @ORM\Column(type="text")
     */
    private $intervenantAffecte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnseignement;

    public function getIdMatiere(): ?int
    {
        return $this->idMatiere;
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

    public function getIntervenantAffecte(): ?string
    {
        return $this->intervenantAffecte;
    }

    public function setIntervenantAffecte(string $intervenantAffecte): self
    {
        $this->intervenantAffecte = $intervenantAffecte;

        return $this;
    }

    public function getDateEnseignement(): ?\DateTimeInterface
    {
        return $this->dateEnseignement;
    }

    public function setDateEnseignement(\DateTimeInterface $dateEnseignement): self
    {
        $this->dateEnseignement = $dateEnseignement;

        return $this;
    }
}
