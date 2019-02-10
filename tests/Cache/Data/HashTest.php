<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Cache\Data;

use Jstewmc\Gravity\Cache\Exception\NotFound;
use PHPUnit\Framework\TestCase;

/**
 * Hmm, these are tough to do without creating dependencies between the set(),
 * get(), and has() methods. But, if we don't, we're not really testing
 * behavior, just the static return types, which isn't helpful.
 */
class HashTest extends TestCase
{
    public function testClear(): void
    {
        $key = 'foo';

        $cache = new Hash();

        $cache->set($key, 1);

        $this->assertTrue($cache->has($key));
        $this->assertTrue($cache->clear());
        $this->assertFalse($cache->has($key));

        return;
    }

    public function testDelete(): void
    {
        $key = 'foo';

        $cache = new Hash();

        $cache->set($key, 1);

        $this->assertTrue($cache->has($key));
        $this->assertTrue($cache->delete($key));
        $this->assertFalse($cache->has($key));

        return;
    }

    public function testGetThrowsExceptionIfValueDoesNotExist(): void
    {
        $this->expectException(NotFound::class);

        (new Hash())->get('foo');

        return;
    }

    public function testGetReturnsValueIfValueDoesExist(): void
    {
        $key   = 'foo';
        $value = 1;

        $cache = new Hash();

        $cache->set($key, $value);

        $this->assertEquals($value, $cache->get($key));

        return;
    }

    public function testHasReturnsFalseIfKeyDoesNotExist(): void
    {
        $this->assertFalse((new Hash())->has('foo'));

        return;
    }

    public function testHasReturnsTrueIfValueDoesExist(): void
    {
        $cache = new Hash();

        $cache->set('foo', 1);

        $this->assertTrue($cache->has('foo'));

        return;
    }

    public function testSet(): void
    {
        $cache = new Hash();

        $this->assertTrue($cache->set('foo', true));
        $this->assertTrue($cache->has('foo'));

        return;
    }
}
