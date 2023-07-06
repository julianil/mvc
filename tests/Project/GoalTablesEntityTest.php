<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen GoalTables.
 */

class GoalTablesEntityTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testSetGetGoalTables()
    {
        $goal = new GoalTables();
        $this->assertInstanceOf("App\Entity\GoalTables", $goal);

        $goal->setIndicator("Test");
        $goal->setTableCode("test1");

        $this->assertIsObject($goal);
        $this->assertStringContainsString("Test", $goal->getIndicator());
        $this->assertStringContainsString("test1", $goal->getTableCode());
    }
}
