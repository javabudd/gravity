<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Project\Data;

use Jstewmc\Gravity\Alias\Data\Resolved as Alias;
use Jstewmc\Gravity\Alias\Exception\NotFound as AliasNotFound;
use Jstewmc\Gravity\Deprecation\Data\Resolved as Deprecation;
use Jstewmc\Gravity\Deprecation\Exception\NotFound as DeprecationNotFound;
use Jstewmc\Gravity\Id\Data\Id;
use Jstewmc\Gravity\Id\Data\Service as ServiceId;
use Jstewmc\Gravity\Id\Data\Setting as SettingId;
use Jstewmc\Gravity\Path\Data\Setting as SettingPath;
use Jstewmc\Gravity\Requirement\Data\Resolved as Requirement;
use Jstewmc\Gravity\Root\Data\Root;
use Jstewmc\Gravity\Service\Data\Service;
use Jstewmc\Gravity\Service\Exception\NotFound as ServiceNotFound;
use Jstewmc\Gravity\Setting\Data\Setting;
use Jstewmc\Gravity\Setting\Exception\NotFound as SettingNotFound;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    private $root;

    public function setUp(): void
    {
        $this->root = $this->createMock(Root::class);
    }

    public function testAddAlias(): void
    {
        $alias = $this->createMock(Alias::class);

        $project = new Project($this->root);

        $this->assertSame($project, $project->addAlias($alias));
    }

    public function testAddDeprecation(): void
    {
        $deprecation = $this->createMock(Deprecation::class);

        $project = new Project($this->root);

        $this->assertSame($project, $project->addDeprecation($deprecation));
    }

    public function testAddRequirement(): void
    {
        $requirement = $this->createMock(Requirement::class);

        $project = new Project($this->root);

        $this->assertSame($project, $project->addRequirement($requirement));
    }

    public function testAddService(): void
    {
        $service = $this->createMock(Service::class);

        $project = new Project($this->root);

        $this->assertSame($project, $project->addService($service));
    }

    public function testAddSetting(): void
    {
        $setting = $this->createMock(Setting::class);
        $setting->method('getArray')->willReturn([]);

        $project = new Project($this->root);

        $this->assertSame($project, $project->addSetting($setting));
    }

    public function testGetAliasThrowsExceptionIfDoesNotExist(): void
    {
        $this->expectException(AliasNotFound::class);

        $id = $this->createMock(Id::class);

        (new Project($this->root))->getAlias($id);
    }

    public function testGetAliasReturnsAliasIfDoesExist(): void
    {
        $id = $this->createMock(Id::class);
        $id->method('__toString')->willReturn('foo');

        $alias = $this->createMock(Alias::class);
        $alias->method('getSource')->willReturn($id);

        $project = (new Project($this->root))->addAlias($alias);

        $this->assertSame($alias, $project->getAlias($id));
    }

    public function testGetDeprecationThrowsExceptionIfDoesNotExist(): void
    {
        $this->expectException(DeprecationNotFound::class);

        $id = $this->createMock(Id::class);

        (new Project($this->root))->getDeprecation($id);
    }

    public function testGetDeprecationReturnsDeprecationIfDoesExist(): void
    {
        $id = $this->createMock(Id::class);
        $id->method('__toString')->willReturn('foo');

        $deprecation = $this->createMock(Deprecation::class);
        $deprecation->method('getSource')->willReturn($id);

        $project = (new Project($this->root))->addDeprecation($deprecation);

        $this->assertSame($deprecation, $project->getDeprecation($id));
    }

    public function testGetRequirements(): void
    {
        $this->assertEquals([], (new Project($this->root))->getRequirements());
    }

    public function testGetRoot(): void
    {
        $root = $this->root;

        $this->assertEquals($root, (new Project($root))->getRoot());
    }

    public function testGetServiceThrowsExceptionIfDoesNotExist(): void
    {
        $this->expectException(ServiceNotFound::class);

        $id = $this->createMock(ServiceId::class);

        (new Project($this->root))->getService($id);
    }

    public function testGetServiceReturnsServiceIfDoesExist(): void
    {
        $id = $this->createMock(ServiceId::class);
        $id->method('__toString')->willReturn('foo');

        $service = $this->createMock(Service::class);
        $service->method('getId')->willReturn($id);

        $project = (new Project($this->root))->addService($service);

        $this->assertSame($service, $project->getService($id));
    }

    public function testGetServices(): void
    {
        $this->assertEquals([], (new Project($this->root))->getServices());
    }

    public function testGetSettingThrowsExceptionIfDoesNotExist(): void
    {
        $this->expectException(SettingNotFound::class);

        $id = $this->createMock(SettingId::class);
        $id->method('getSegments')->willReturn(['foo', 'bar', 'baz']);

        (new Project($this->root))->getSetting($id);
    }

    public function testGetSettingReturnsSettingIfDoesExist(): void
    {
        $id = $this->createMock(SettingId::class);
        $id->method('__toString')->willReturn('foo.bar.baz');
        $id->method('getSegments')->willReturn(['foo', 'bar', 'baz']);

        $setting = $this->createMock(Setting::class);
        $setting->method('getId')->willReturn($id);
        $setting->method('getArray')->willReturn(['foo' => ['bar' => ['baz' => 1]]]);

        $project = (new Project($this->root))->addSetting($setting);

        $this->assertEquals(1, $project->getSetting($id));
    }

    public function testHasAliasReturnsFalseIfDoesNotExist(): void
    {
        $id = $this->createMock(Id::class);

        $this->assertFalse((new Project($this->root))->hasAlias($id));

        return;
    }

    public function testHasAliasReturnsTrueIfDoesExist(): void
    {
        $id = $this->createMock(Id::class);
        $id->method('__toString')->willReturn('foo');

        $alias = $this->createMock(Alias::class);
        $alias->method('getSource')->willReturn($id);

        $project = (new Project($this->root))->addAlias($alias);

        $this->assertTrue($project->hasAlias($id));
    }

    public function testHasDeprecationReturnsFalseIfDoesNotExist(): void
    {
        $id = $this->createMock(Id::class);

        $this->assertFalse((new Project($this->root))->hasDeprecation($id));
    }

    public function testHasDeprecationReturnsTrueIfDoesExist(): void
    {
        $id = $this->createMock(Id::class);
        $id->method('__toString')->willReturn('foo');

        $deprecation = $this->createMock(Deprecation::class);
        $deprecation->method('getSource')->willReturn($id);

        $project = (new Project($this->root))->addDeprecation($deprecation);

        $this->assertTrue($project->hasDeprecation($id));
    }

    public function testHasServiceReturnsFalseIfDoesNotExist(): void
    {
        $id = $this->createMock(Id::class);

        $this->assertFalse((new Project($this->root))->hasService($id));
    }

    public function testHasServiceReturnsTrueIfDoesExist(): void
    {
        $id = $this->createMock(ServiceId::class);
        $id->method('__toString')->willReturn('foo');

        $service = $this->createMock(Service::class);
        $service->method('getId')->willReturn($id);

        $project = (new Project($this->root))->addService($service);

        $this->assertTrue($project->hasService($id));
    }

    public function testHasSettingReturnsFalseIfDoesNotExist(): void
    {
        $id = $this->createMock(Id::class);
        $id->method('getSegments')->willReturn(['foo', 'bar', 'baz']);

        $this->assertFalse((new Project($this->root))->hasSetting($id));
    }

    public function testHasSettingReturnsTrueIfDoesExist(): void
    {
        $path = $this->createMock(SettingPath::class);
        $path->method('getSegments')->willReturn(['foo', 'bar', 'baz']);

        $id = $this->createMock(SettingId::class);
        $id->method('__toString')->willReturn('foo.bar.baz');
        $id->method('getPath')->willReturn($path);

        $setting = $this->createMock(Setting::class);
        $setting->method('getId')->willReturn($id);
        $setting->method('getArray')->willReturn(['foo' => ['bar' => ['baz' => 1]]]);

        $project = (new Project($this->root))->addSetting($setting);

        $this->assertTrue($project->hasSetting($id));
    }
}
