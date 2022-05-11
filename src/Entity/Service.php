<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
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
     * @ORM\ManyToOne(targetEntity=Division::class, inversedBy="services")
     * @ORM\JoinColumn(nullable=false)
     */
    private $division;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="services")
     */
    private $chef;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDivision(): ?Division
    {
        return $this->division;
    }

    public function setDivision(?Division $division): self
    {
        $this->division = $division;

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
