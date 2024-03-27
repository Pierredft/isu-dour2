<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'niveaux')]
    private ?Enseignement $enseignement = null;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Formation::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $formations;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
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

    public function getEnseignement(): ?Enseignement
    {
        return $this->enseignement;
    }

    public function setEnseignement(?Enseignement $enseignement): static
    {
        $this->enseignement = $enseignement;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation))
        {
            $this->formations->add($formation);
            $formation->setNiveau($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->formations->removeElement($formation))
        {
            // set the owning side to null (unless already changed)
            if ($formation->getNiveau() === $this)
            {
                $formation->setNiveau(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->enseignement->getTitre() . ' > ' . $this->titre;
    }
}
