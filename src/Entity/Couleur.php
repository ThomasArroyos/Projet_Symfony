<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouleurRepository::class)
 */
class Couleur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $fond;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $bordure;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $texte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFond(): ?string
    {
        return $this->fond;
    }

    public function setFond(string $fond): self
    {
        $this->fond = $fond;

        return $this;
    }

    public function getBordure(): ?string
    {
        return $this->bordure;
    }

    public function setBordure(string $bordure): self
    {
        $this->bordure = $bordure;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }
}
