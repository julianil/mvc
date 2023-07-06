<?php

namespace App\Entity;

use App\Repository\MilestonesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents the milestones connected to the goal.
 * The get methods gets the code (name of table), the milestones number, name of milestone
 * as well as a description of the milestone.
 * The set methods sets the code (name of table), the milestones number, name of milestone
 * as well as a description of the milestone.
 */

#[ORM\Entity(repositoryClass: MilestonesRepository::class)]
class Milestones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    #[ORM\Column(length: 3)]
    private ?string $number = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}
