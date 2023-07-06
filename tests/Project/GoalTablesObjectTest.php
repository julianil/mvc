<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\GoalTablesRepository;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen GoalTables.
 */
class GoalTablesRepositoryTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testCreateGoalTables()
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $goal = new GoalTablesRepository($manager);
        $this->assertInstanceOf("App\Repository\GoalTablesRepository", $goal);

        $this->assertIsObject($goal);
    }
}
