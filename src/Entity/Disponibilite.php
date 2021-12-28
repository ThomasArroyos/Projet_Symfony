<?php

namespace App\Entity;

use App\Repository\DisponibiliteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisponibiliteRepository::class)
 */
class Disponibilite
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
    private $periode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $conflitCours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriode(): ?int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getConflitCours(): ?bool
    {
        return $this->conflitCours;
    }

    public function setConflitCours(bool $conflitCours): self
    {
        $this->conflitCours = $conflitCours;

        return $this;
    }
}
