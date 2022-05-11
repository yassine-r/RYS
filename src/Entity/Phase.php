<?php

namespace App\Entity;

use App\Repository\PhaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhaseRepository::class)
 */
class Phase
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dated;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datef;

    /**
     * @ORM\OneToMany(targetEntity=Tache::class, mappedBy="phase")
     */
    private $liste_taches;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="liste_phases")
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    public function __construct()
    {
        $this->liste_taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDated(): ?\DateTimeInterface
    {
        return $this->dated;
    }

    public function setDated(?\DateTimeInterface $dated): self
    {
        $this->dated = $dated;

        return $this;
    }

    public function getDatef(): ?\DateTimeInterface
    {
        return $this->datef;
    }

    public function setDatef(?\DateTimeInterface $datef): self
    {
        $this->datef = $datef;

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getListeTaches(): Collection
    {
        return $this->liste_taches;
    }

    public function addListeTach(Tache $listeTach): self
    {
        if (!$this->liste_taches->contains($listeTach)) {
            $this->liste_taches[] = $listeTach;
            $listeTach->setPhase($this);
        }

        return $this;
    }

    public function removeListeTach(Tache $listeTach): self
    {
        if ($this->liste_taches->removeElement($listeTach)) {
            // set the owning side to null (unless already changed)
            if ($listeTach->getPhase() === $this) {
                $listeTach->setPhase(null);
            }
        }

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function __toString()
    {
        $x =$this->nom;
        return $x;
    }
}
