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
     * @ORM\Column(type="integer")
     */
    private $nbEleveTotal;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelleClasse;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="classeId")
     */
    private $groupes;

    /**
     * @ORM\ManyToMany(targetEntity=Matiere::class, inversedBy="classes")
     */
    private $matieres;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, mappedBy="classes")
     */
    private $formations;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLibelleClasse(): ArrayCollection
    {
        return $this->libelleClasse;
    }

    public function setLibelleClasse(ArrayCollection $libelleClasse): void
    {
        $this->libelleClasse = $libelleClasse;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->setClasseId($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getClasseId() === $this) {
                $groupe->setClasseId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        $this->matieres->removeElement($matiere);

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->addClass($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeClass($this);
        }

        return $this;
    }
}
