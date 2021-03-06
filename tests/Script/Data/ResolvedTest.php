<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Script\Data;

use PHPUnit\Framework\TestCase;

class ResolvedTest extends TestCase
{
    public function testGetAliases(): void
    {
        $this->assertEquals([], (new Resolved())->getAliases());
    }

    public function testGetDefinitions(): void
    {
        $this->assertEquals([], (new Resolved())->getDefinitions());
    }

    public function testGetDeprecations(): void
    {
        $this->assertEquals([], (new Resolved())->getDeprecations());
    }

    public function testGetRequirements(): void
    {
        $this->assertEquals([], (new Resolved())->getRequirements());
    }

    public function testSetAliases(): void
    {
        $script = new Resolved();

        $this->assertSame($script, $script->setAliases([]));
    }

    public function testSetDefinitions(): void
    {
        $script = new Resolved();

        $this->assertSame($script, $script->setDefinitions([]));
    }

    public function testSetDeprecations(): void
    {
        $script = new Resolved();

        $this->assertSame($script, $script->setDeprecations([]));
    }

    public function testSetRequirements(): void
    {
        $script = new Resolved();

        $this->assertSame($script, $script->setRequirements([]));
    }
}
