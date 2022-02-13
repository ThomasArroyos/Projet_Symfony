<?php

namespace App\Entity;

use App\Repository\DisponibiliteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=DisponibiliteRepository::class)
 */
class Possibilite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne (targetEntity="App\Entity\Formation", inversedBy="periodes")
     * @ORM\JoinColumn (name="periodes", referencedColumnName="periode")
     */
    private $periode;

    /**
     * @ORM\Column(type="date", name="disponibilite")
     * @ORM\ManyToOne (targetEntity="App\Entity\Intervenant", inversedBy="disponibilites")
     * @ORM\JoinColumn(name="disponibilites", referencedColumnName="disponibilite")
     */
    private $disponibilite;

    public function getId(): int
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

    public function getDisponibilite(): ?Date
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(Date $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }
}