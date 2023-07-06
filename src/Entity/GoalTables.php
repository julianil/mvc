<?php

namespace App\Entity;

use App\Repository\GoalTablesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoalTablesRepository::class)]
class GoalTables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $indicator = null;

    #[ORM\Column(length: 10)]
    private ?string $table_code = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndicator(): ?string
    {
        return $this->indicator;
    }

    public function setIndicator(string $indicator): self
    {
        $this->indicator = $indicator;

        return $this;
    }

    public function getTableCode(): ?string
    {
        return $this->table_code;
    }

    public function setTableCode(string $table_code): self
    {
        $this->table_code = $table_code;

        return $this;
    }
}
