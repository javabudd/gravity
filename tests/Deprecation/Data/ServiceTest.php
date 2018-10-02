<?php
/**
 * The file for the service deprecation tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Deprecation\Data;

use Jstewmc\Gravity\Id\Data\Service as Id;
use PHPUnit\Framework\TestCase;

/**
 * Tests for a service deprecation
 *
 * @since  0.1.0
 */
class ServiceTest extends TestCase
{
    public function testGetId(): void
    {
        $id = $this->createMock(Id::class);

        $deprecation = new Service($id);

        $this->assertSame($id, $deprecation->getId());

        return;
    }

    public function testGetReplacement(): void
    {
        $id  = $this->createMock(Id::class);
        $replacement = $this->createMock(Id::class);

        $deprecation = new Service($id, $replacement);

        $this->assertSame($replacement, $deprecation->getReplacement());

        return;
    }

    public function testHasReplacementReturnsFalseIfReplacementDoesNotExist(): void
    {
        $id  = $this->createMock(Id::class);

        $deprecation = new Service($id);

        $this->assertFalse($deprecation->hasReplacement());

        return;
    }

    public function testHasReplacementReturnsTrueIfReplacementDoesExist(): void
    {
        $id  = $this->createMock(Id::class);
        $replacement = $this->createMock(Id::class);

        $deprecation = new Service($id, $replacement);

        $this->assertTrue($deprecation->hasReplacement());

        return;
    }

    public function testSetReplacement(): void
    {
        $id  = $this->createMock(Id::class);
        $replacement = $this->createMock(Id::class);

        $deprecation = new Service($id);

        $this->assertSame($deprecation, $deprecation->setReplacement($replacement));

        return;
    }
}
