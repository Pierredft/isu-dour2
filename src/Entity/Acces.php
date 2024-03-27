<?php

namespace App\Entity;

use App\Repository\AccesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccesRepository::class)]
class Acces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $logo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pdf $pdf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    public function setLogo(?Image $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPdf(): ?Pdf
    {
        return $this->pdf;
    }

    public function setPdf(?Pdf $pdf): static
    {
        $this->pdf = $pdf;

        return $this;
    }
}
