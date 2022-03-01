<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=50)
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
     * @ORM\Column(type="float")
     */
    private $dureeMatieres;

    /**
     * @ORM\ManyToMany(targetEntity=Matiere::class, inversedBy="formations")
     */
    private $matieres;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, inversedBy="formations")
     */
    private $classes;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getDureeMatieres(): ?float
    {
        return $this->dureeMatieres;
    }

    public function setDureeMatieres(float $dureeMatieres): self
    {
        $this->dureeMatieres = $dureeMatieres;

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
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        $this->classes->removeElement($class);

        return $this;
    }
}
