<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Statistics.
 */

class StatisticsEntityTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testSetGetStatistics()
    {
        $stat = new Statistics();
        $this->assertInstanceOf("App\Entity\Statistics", $stat);

        $stat->setYear(2023);
        $stat->setWomen(100);
        $stat->setMen(89);
        $stat->setDifference(11);
        $stat->setCategory("Test");

        $this->assertIsObject($stat);
        $this->assertStringContainsString(2023, $stat->getYear());
        $this->assertStringContainsString(100, $stat->getWomen());
        $this->assertStringContainsString(89, $stat->getMen());
        $this->assertStringContainsString(11, $stat->getDifference());
        $this->assertStringContainsString("Test", $stat->getCategory());
    }
}
