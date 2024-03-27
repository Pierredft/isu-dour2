<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'image', fileNameProperty: 'filename', originalName: 'originalFilename')]
    private ?File $file = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $originalFilename = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Visite $visite = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Accueil $accueil = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Projet $projet = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Formation $formation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file = null): void
    {
        $this->file = $file;
        if (null !== $file)
        {
            $this->updatedAt = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        }
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getOriginalFilename(): ?string
    {
        return $this->originalFilename;
    }

    public function setOriginalFilename(?string $originalFilename): static
    {
        $this->originalFilename = $originalFilename;

        return $this;
    }

    public function getVisite(): ?Visite
    {
        return $this->visite;
    }

    public function setVisite(?Visite $visite): static
    {
        $this->visite = $visite;

        return $this;
    }

    public function getAccueil(): ?Accueil
    {
        return $this->accueil;
    }

    public function setAccueil(?Accueil $accueil): static
    {
        $this->accueil = $accueil;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
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

    public function __toString()
    {
        return $this->originalFilename ?? 'Aucune image';
    }
}
