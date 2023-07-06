<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Goal5.
 */

class Goal5EntityTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testSetGetGoal5()
    {
        $goal = new Goal5();
        $this->assertInstanceOf("App\Entity\Goal5", $goal);

        $goal->setName("goals");

        $this->assertIsObject($goal);
        $this->assertStringContainsString("goals", $goal->getName());
    }
}
