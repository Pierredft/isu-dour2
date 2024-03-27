<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(nullable:true)]
    private ?int $heures = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?CoursCategorie $coursCategorie = null;

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getHeures(): ?int
    {
        return $this->heures;
    }

    public function setHeures(?int $heures): static
    {
        $this->heures = $heures;

        return $this;
    }

    public function getCoursCategorie(): ?CoursCategorie
    {
        return $this->coursCategorie;
    }

    public function setCoursCategorie(?CoursCategorie $coursCategorie): static
    {
        $this->coursCategorie = $coursCategorie;

        return $this;
    }
}
