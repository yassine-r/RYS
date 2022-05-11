<?php

namespace App\Entity;

use App\Repository\DivisionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DivisionRepository::class)
 */
class Division
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
    private $Nom;


    /**
     * @ORM\OneToMany(targetEntity=Employee::class, mappedBy="division")
     */
    private $employees;

    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="division")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="divisions")
     */
    private $chef;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }



    /**
     * @return Collection|Employee[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setDivision($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getDivision() === $this) {
                $employee->setDivision(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->Nom;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setDivision($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getDivision() === $this) {
                $service->setDivision(null);
            }
        }

        return $this;
    }

    public function getChef(): ?Employee
    {
        return $this->chef;
    }

    public function setChef(?Employee $chef): self
    {
        $this->chef = $chef;

        return $this;
    }
}
