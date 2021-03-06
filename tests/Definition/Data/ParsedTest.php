<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Definition\Data;

use Jstewmc\Gravity\Path\Data\Path;
use PHPUnit\Framework\TestCase;

class ParsedTest extends TestCase
{
    public function testGetKey(): void
    {
        $path = $this->createMock(Path::class);

        $this->assertSame($path, (new Parsed($path))->getKey());

        return;
    }

    public function testGetValue(): void
    {
        $path = $this->createMock(Path::class);

        $this->assertNull((new Parsed($path))->getValue());

        return;
    }
}
