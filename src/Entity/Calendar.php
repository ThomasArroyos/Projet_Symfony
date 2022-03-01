<?php

namespace App\Entity;

use App\Repository\CalendarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendarRepository::class)
 */
class Calendar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="boolean")
     */
    private $all_day;

    /**
     * @ORM\Column(type="string", length=100)
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @ORM\OneToMany(targetEntity=Matiere::class, mappedBy="nomMatiere")
     */
    private $nomMatiere;

    public function __construct()
    {
        $this->nomMatiere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getAllDay(): ?bool
    {
        return $this->all_day;
    }

    public function setAllDay(bool $all_day): self
    {
        $this->all_day = $all_day;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getNomMatiere(): Collection
    {
        return $this->nomMatiere;
    }

    public function addNomMatiere(Matiere $nomMatiere): self
    {
        if (!$this->nomMatiere->contains($nomMatiere)) {
            $this->nomMatiere[] = $nomMatiere;
            $nomMatiere->setCalendar($this);
        }

        return $this;
    }

    public function removeNomMatiere(Matiere $nomMatiere): self
    {
        if ($this->nomMatiere->removeElement($nomMatiere)) {
            // set the owning side to null (unless already changed)
            if ($nomMatiere->getCalendar() === $this) {
                $nomMatiere->setCalendar(null);
            }
        }

        return $this;
    }
}
