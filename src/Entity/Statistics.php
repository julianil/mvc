<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents the statistics of the goal.
 * The get methods gets the code (name of table), year, stats for women, stats for men, 
 * the difference between the stats for women and men and the category to which the stats belongs.
 * The set methods sets the code (name of table), year, stats for women, stats for men, 
 * the difference between the stats for women and men and the category to which the stats belongs.
 */

#[ORM\Entity(repositoryClass: StatisticsRepository::class)]
class Statistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $women = null;

    #[ORM\Column]
    private ?int $men = null;

    #[ORM\Column(nullable: true)]
    private ?int $difference = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $category = null;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getWomen(): ?int
    {
        return $this->women;
    }

    public function setWomen(int $women): self
    {
        $this->women = $women;

        return $this;
    }

    public function getMen(): ?int
    {
        return $this->men;
    }

    public function setMen(int $men): self
    {
        $this->men = $men;

        return $this;
    }

    public function getDifference(): ?int
    {
        return $this->difference;
    }

    public function setDifference(?int $difference): self
    {
        $this->difference = $difference;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
