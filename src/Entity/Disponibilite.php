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
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne (targetEntity="App\Entity\Intervenant", inversedBy="dispo_perso")
     * @ORM\ManyToOne (targetEntity="App\Entity\Formation", inversedBy="periode_dispo")
     * @ORM\JoinColumn (name="dispo_perso", referencedColumnName="periode")
     * @ORM\JoinColumn (name="periode_dispo", referencedColumnName="periode")
     */
    private $periode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $conflitCours;

    /**
     * @ORM\Column (type="integer"
     * @OR\ManyToMany
     */

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
