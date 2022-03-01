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
     * @ORM\Column(type="float")
     */
    private $dureeTotale;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $intervenantAffecte;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomMatiere;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, mappedBy="matieres")
     */
    private $classes;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, mappedBy="matieres")
     */
    private $formations;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="matieres")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Calendar::class, mappedBy="matiere")
     */
    private $calendars;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->calendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIntervenantAffecte()
    {
        return $this->intervenantAffecte;
    }

    public function setIntervenantAffecte($intervenantAffecte): void
    {
        $this->intervenantAffecte = $intervenantAffecte;
    }

    public function getNomMatiere()
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere($nomMatiere): void
    {
        $this->nomMatiere = $nomMatiere;
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
            $class->addMatiere($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeMatiere($this);
        }

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
            $formation->addMatiere($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeMatiere($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addMatiere($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeMatiere($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars[] = $calendar;
            $calendar->addMatiere($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->removeElement($calendar)) {
            $calendar->removeMatiere($this);
        }

        return $this;
    }
}
