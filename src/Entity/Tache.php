<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Phase::class, inversedBy="liste_taches")
     */
    private $phase;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="taches")
     */
    private $responsable;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function getResponsable(): ?Employee
    {
        return $this->responsable;
    }

    public function setResponsable(?Employee $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function __toString()
    {
        $x='date de début :';
        $x =$x. $this->dated->format('d/m/Y') . ', date de fin: ' . $this->datef->format('d/m/Y') . ',description : ' . $this->description;
        return $x;
    }
}
