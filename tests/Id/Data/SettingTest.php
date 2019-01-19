<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Id\Data;

use Jstewmc\Gravity\Path\Data\Setting as Path;
use PHPUnit\Framework\TestCase;

/**
 * @group  id
 */
class SettingTest extends TestCase
{
    public function testToString(): void
    {
        $string = 'foo.bar.baz';

        $path = $this->createMock(Path::class);
        $path->method('__toString')->willReturn($string);
        $path->method('getLength')->willReturn(3);

        $id = new Setting($path);

        $this->assertEquals($string, (string)$id);

        return;
    }

    public function testGetPath(): void
    {
        $path = $this->createMock(Path::class);
        $path->method('getLength')->willReturn(3);

        $id = new Setting($path);

        $this->assertSame($path, $id->getPath());

        return;
    }
}
