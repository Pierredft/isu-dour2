<?php

namespace App\Entity;

use App\Repository\AccueilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccueilRepository::class)]
class Accueil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Video $video = null;

    #[ORM\OneToMany(mappedBy: 'accueil', targetEntity: Image::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'accueil', targetEntity: Actualite::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $actualites;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->actualites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): static
    {
        $this->video = $video;

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
            $image->setAccueil($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image))
        {
            // set the owning side to null (unless already changed)
            if ($image->getAccueil() === $this)
            {
                $image->setAccueil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actualite>
     */
    public function getActualites(): Collection
    {
        return $this->actualites;
    }

    public function addActualite(Actualite $actualite): static
    {
        if (!$this->actualites->contains($actualite))
        {
            $this->actualites->add($actualite);
            $actualite->setAccueil($this);
        }

        return $this;
    }

    public function removeActualite(Actualite $actualite): static
    {
        if ($this->actualites->removeElement($actualite))
        {
            // set the owning side to null (unless already changed)
            if ($actualite->getAccueil() === $this)
            {
                $actualite->setAccueil(null);
            }
        }

        return $this;
    }
}
