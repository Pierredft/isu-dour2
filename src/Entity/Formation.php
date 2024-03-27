<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $nom = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $logo = null;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: Image::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?Niveau $niveau = null;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: CoursCategorie::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $coursCategories;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pdf $horraires = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->coursCategories = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image))
        {
            $this->images->add($image);
            $image->setFormation($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image))
        {
            // set the owning side to null (unless already changed)
            if ($image->getFormation() === $this)
            {
                $image->setFormation(null);
            }
        }

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, CoursCategorie>
     */
    public function getCoursCategories(): Collection
    {
        return $this->coursCategories;
    }

    public function addCoursCategory(CoursCategorie $coursCategory): static
    {
        if (!$this->coursCategories->contains($coursCategory)) {
            $this->coursCategories->add($coursCategory);
            $coursCategory->setFormation($this);
        }

        return $this;
    }

    public function removeCoursCategory(CoursCategorie $coursCategory): static
    {
        if ($this->coursCategories->removeElement($coursCategory)) {
            // set the owning side to null (unless already changed)
            if ($coursCategory->getFormation() === $this) {
                $coursCategory->setFormation(null);
            }
        }

        return $this;
    }

    public function getHorraires(): ?Pdf
    {
        return $this->horraires;
    }

    public function setHorraires(?Pdf $horraires): static
    {
        $this->horraires = $horraires;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
