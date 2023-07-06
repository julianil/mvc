<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Milestones.
 */

class MilestonesEntityTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testSetGetMilestones()
    {
        $milestone = new Milestones();
        $this->assertInstanceOf("App\Entity\Milestones", $milestone);

        $milestone->setCode("test1");
        $milestone->setNumber("5a");
        $milestone->setName("Test");
        $milestone->setDescription("En test beskrivning");

        $this->assertIsObject($milestone);
        $this->assertStringContainsString("test1", $milestone->getCode());
        $this->assertStringContainsString("5a", $milestone->getNumber());
        $this->assertStringContainsString("Test", $milestone->getName());
        $this->assertStringContainsString("En test beskrivning", $milestone->getDescription());
    }
}
