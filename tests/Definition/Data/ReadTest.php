<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Definition\Data;

use PHPUnit\Framework\TestCase;

class ReadTest extends TestCase
{
    public function testGetKey(): void
    {
        $this->assertEquals('foo', (new Read('foo'))->getKey());
    }

    public function testGetValue(): void
    {
        $this->assertNull((new Read('foo'))->getValue());
    }
}
