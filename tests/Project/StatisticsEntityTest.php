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

        $stat->setCode("test1");
        $stat->setYear(2023);
        $stat->setWomen(100);
        $stat->setMen(89);
        $stat->setDifference(11);
        $stat->setCategory("Test");

        $this->assertIsObject($stat);
        $this->assertStringContainsString("test1", $stat->getCode());
        $this->assertEquals(2023, $stat->getYear());
        $this->assertEquals(100, $stat->getWomen());
        $this->assertEquals(89, $stat->getMen());
        $this->assertEquals(11, $stat->getDifference());
        $this->assertStringContainsString("Test", $stat->getCategory());
    }
}
