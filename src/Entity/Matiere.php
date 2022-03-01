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
     * @ORM\Column(type="string", length=50)
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="matieres")
     * @ORM\ManyToOne(targetEntity=Calendar::class, inversedBy="nomMatiere")
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="matieres")
     */
    private $nomMatiere;

    /**
     * @ORM\Column(type="float")
     */
    private $dureeTotale;

    /**
     * @ORM\OneToOne(targetEntity=Couleur::class, cascade={"persist", "remove"})
     */
    private $couleurMatiere;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $intervenantAffecte;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, inversedBy="matieres")
     */
    private $classes;

    public function __construct()
    {
        $this->intervenantAffecte = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<string, Formation, User>
     */
    public function getNomMatiere(): Collection
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

    public function getCouleurMatiere(): ?Couleur
    {
        return $this->couleurMatiere;
    }

    public function setCouleurMatiere(?Couleur $couleurMatiere): self
    {
        $this->couleurMatiere = $couleurMatiere;

        return $this;
    }

    public function addNomMatiere(Formation $nomMatiere): self
    {
        if (!$this->nomMatiere->contains($nomMatiere)) {
            $this->nomMatiere[] = $nomMatiere;
        }

        return $this;
    }

    public function removeNomMatiere(Formation $nomMatiere): self
    {
        $this->nomMatiere->removeElement($nomMatiere);

        return $this;
    }

    /**
     * @return Collection<string, Classe>
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
