<?php

namespace App\Entity;

use App\Repository\CoursCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursCategorieRepository::class)]
class CoursCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'coursCategorie', targetEntity: Cours::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $cours;

    #[ORM\ManyToOne(inversedBy: 'coursCategories')]
    private ?Formation $formation = null;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre ?? '';
    }

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

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setCoursCategorie($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getCoursCategorie() === $this) {
                $cour->setCoursCategorie(null);
            }
        }

        return $this;
    }

    public function getTotalHeures(): int
    {
        $total = 0;
        foreach($this->cours as $cours)
        {
            $total += $cours->getHeures();
        }
        return $total;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }
}
