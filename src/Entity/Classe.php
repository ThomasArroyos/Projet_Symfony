<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="classes")
     */
    private $libelleClasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEleveTotal;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="id")
     */
    private $groupeId;

    /**
     * @ORM\Column(type="string", length=50)
     * @ORM\ManyToMany(targetEntity=Matiere::class, mappedBy="classes")
     */
    private $matieres;

    public function __construct()
    {
        $this->groupeId = new ArrayCollection();
        $this->matieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleClasse(): ?string
    {
        return $this->libelleClasse;
    }

    public function setLibelleClasse(string $libelleClasse): self
    {
        $this->libelleClasse = $libelleClasse;

        return $this;
    }

    public function getNbEleveTotal(): ?int
    {
        return $this->nbEleveTotal;
    }

    public function setNbEleveTotal(int $nbEleveTotal): self
    {
        $this->nbEleveTotal = $nbEleveTotal;

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupeId(): Collection
    {
        return $this->groupeId;
    }

    public function addGroupeId(Groupe $groupeId): self
    {
        if (!$this->groupeId->contains($groupeId)) {
            $this->groupeId[] = $groupeId;
            $groupeId->setClasse($this);
        }

        return $this;
    }

    public function removeGroupeId(Groupe $groupeId): self
    {
        if ($this->groupeId->removeElement($groupeId)) {
            // set the owning side to null (unless already changed)
            if ($groupeId->getClasse() === $this) {
                $groupeId->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<string, Matiere>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->addClass($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            $matiere->removeClass($this);
        }

        return $this;
    }
}
