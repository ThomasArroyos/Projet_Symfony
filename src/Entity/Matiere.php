<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     */
    private $nomMatiere;

    /**
     * @ORM\Column(type="float")
     */
    private $dureeTotale;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="matieres")
     */
    private $intervenantAffecte;

    public function __construct()
    {
        $this->intervenantAffecte = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getDureeTotale(): ?float
    {
        return $this->dureeTotale;
    }

    public function setDureeTotale(float $dureeTotale): self
    {
        $this->dureeTotale = $dureeTotale;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIntervenantAffecte(): Collection
    {
        return $this->intervenantAffecte;
    }

    public function addIntervenantAffecte(User $intervenantAffecte): self
    {
        if (!$this->intervenantAffecte->contains($intervenantAffecte)) {
            $this->intervenantAffecte[] = $intervenantAffecte;
        }

        return $this;
    }

    public function removeIntervenantAffecte(User $intervenantAffecte): self
    {
        $this->intervenantAffecte->removeElement($intervenantAffecte);

        return $this;
    }
}
