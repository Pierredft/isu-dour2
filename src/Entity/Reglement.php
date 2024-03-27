<?php

namespace App\Entity;

use App\Repository\ReglementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReglementRepository::class)]
class Reglement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'reglement', targetEntity: Pdf::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $pdfs;

    public function __construct()
    {
        $this->pdfs = new ArrayCollection();
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
     * @return Collection<int, Pdf>
     */
    public function getPdfs(): Collection
    {
        return $this->pdfs;
    }

    public function addPdf(Pdf $pdf): static
    {
        if (!$this->pdfs->contains($pdf))
        {
            $this->pdfs->add($pdf);
            $pdf->setReglement($this);
        }

        return $this;
    }

    public function removePdf(Pdf $pdf): static
    {
        if ($this->pdfs->removeElement($pdf))
        {
            // set the owning side to null (unless already changed)
            if ($pdf->getReglement() === $this)
            {
                $pdf->setReglement(null);
            }
        }

        return $this;
    }
}
