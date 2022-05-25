<?php

namespace App\Entity;

use App\Repository\TaillerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaillerRepository::class)"
 * @ORM\Table( 
 * name="tailler", 
 * uniqueConstraints={
 * @ORM\UniqueConstraint(name="association_unique", columns={"haie", "devis" })}
 */
class Tailler
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hauteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longueur;

    /**
     * @ORM\ManyToOne(targetEntity=Haie::class, inversedBy="taillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $haie;

    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="taillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $devis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHauteur(): ?string
    {
        return $this->hauteur;
    }

    public function setHauteur(string $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getLongueur(): ?string
    {
        return $this->longueur;
    }

    public function setLongueur(string $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getHaie(): ?Haie
    {
        return $this->haie;
    }

    public function setHaie(?Haie $haie): self
    {
        $this->haie = $haie;

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): self
    {
        $this->devis = $devis;

        return $this;
    }
    
    public function __toString()
    {
        return $this->devis.$this->client;
        return $this->devis.$this->date;
    }
}
