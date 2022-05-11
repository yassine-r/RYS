<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mpaye;

    /**
     * @ORM\Column(type="date")
     */
    private $datec;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $depenses;

    /**
     * @ORM\ManyToMany(targetEntity=Employee::class, inversedBy="projects")
     */
    private $employee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprietaire;

    /**
     * @ORM\OneToMany(targetEntity=Phase::class, mappedBy="project")
     */
    private $liste_phases;


    public function __construct()
    {
        $this->employee = new ArrayCollection();
        $this->liste_phases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setProprietaire(string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }
    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getMpaye(): ?string
    {
        return $this->mpaye;
    }

    public function setMpaye(string $mpaye): self
    {
        $this->mpaye = $mpaye;

        return $this;
    }

    public function getDatec(): ?\DateTimeInterface
    {
        return $this->datec;
    }

    public function setDatec(\DateTimeInterface $datec): self
    {
        $this->datec = $datec;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDepenses(): ?string
    {
        return $this->depenses;
    }

    public function setDepenses(string $depenses): self
    {
        $this->depenses = $depenses;

        return $this;
    }
    /**
     * @return Collection|Employee[]
     */
    public function getEmployee(): Collection
    {
        return $this->employee;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employee->contains($employee)) {
            $this->employee[] = $employee;
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        $this->employee->removeElement($employee);

        return $this;
    }

    /**
     * @return Collection|Phase[]
     */
    public function getListePhases(): Collection
    {
        return $this->liste_phases;
    }

    public function addListePhase(Phase $listePhase): self
    {
        if (!$this->liste_phases->contains($listePhase)) {
            $this->liste_phases[] = $listePhase;
            $listePhase->setProject($this);
        }

        return $this;
    }

    public function removeListePhase(Phase $listePhase): self
    {
        if ($this->liste_phases->removeElement($listePhase)) {
            // set the owning side to null (unless already changed)
            if ($listePhase->getProject() === $this) {
                $listePhase->setProject(null);
            }
        }

        return $this;
    }

}
