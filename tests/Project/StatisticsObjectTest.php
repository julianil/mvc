<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\StatisticsRepository;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Statistics.
 */
class StatisticsRepositoryTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testCreateStatistics()
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $stat = new StatisticsRepository($manager);
        $this->assertInstanceOf("App\Repository\StatisticsRepository", $stat);

        $this->assertIsObject($stat);
    }
}
