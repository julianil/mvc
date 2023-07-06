<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MilestonesRepository;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Milestones.
 */
class MilestonesRepositoryTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testCreateMilestones()
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $milestone = new MilestonesRepository($manager);
        $this->assertInstanceOf("App\Repository\MilestonesRepository", $milestone);

        $this->assertIsObject($milestone);
    }
}
