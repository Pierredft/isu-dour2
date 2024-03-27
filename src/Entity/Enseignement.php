<?php

namespace App\Entity;

use App\Repository\EnseignementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: EnseignementRepository::class)]
class Enseignement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'enseignement', targetEntity: Niveau::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $niveaux;

    public function __construct()
    {
        $this->niveaux = new ArrayCollection();
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

    /**
     * @return Collection<int, Niveau>
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): static
    {
        if (!$this->niveaux->contains($niveau))
        {
            $this->niveaux->add($niveau);
            $niveau->setEnseignement($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): static
    {
        if ($this->niveaux->removeElement($niveau))
        {
            // set the owning side to null (unless already changed)
            if ($niveau->getEnseignement() === $this)
            {
                $niveau->setEnseignement(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titre;
    }
}
