<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\PdfRepository;
use Doctrine\ORM\Mapping as ORM;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: PdfRepository::class)]
class Pdf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\File(maxSize: '1024k', mimeTypes: ['application/pdf'], extensions:['pdf'=>'application/pdf'])]
    #[Vich\UploadableField(mapping: 'pdf', fileNameProperty: 'filename', originalName: 'originalFilename')]
    private ?File $file = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $originalFilename = null;

    #[ORM\ManyToOne(inversedBy: 'pdfs')]
    private ?Reglement $reglement = null;

    #[ORM\ManyToOne(inversedBy: 'pdfs')]
    private ?Inscription $inscription = null;

    #[ORM\ManyToOne(inversedBy: 'pdfs')]
    private ?Lien $lien = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

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

    public function getReglement(): ?Reglement
    {
        return $this->reglement;
    }

    public function setReglement(?Reglement $reglement): static
    {
        $this->reglement = $reglement;

        return $this;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(?Inscription $inscription): static
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getLien(): ?Lien
    {
        return $this->lien;
    }

    public function setLien(?Lien $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function __toString()
    {
        return $this->originalFilename ?? '';
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
}
