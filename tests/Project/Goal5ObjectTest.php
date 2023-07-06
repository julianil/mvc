<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\Goal5Repository;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Goal5.
 */
class Goal5RepositoryTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testCreateGoal5()
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $goal = new Goal5Repository($manager);
        $this->assertInstanceOf("App\Repository\Goal5Repository", $goal);

        $this->assertIsObject($goal);
    }
}
