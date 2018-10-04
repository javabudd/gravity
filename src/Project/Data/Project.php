<?php
/**
 * The file for a project
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Project\Data;

use Jstewmc\Gravity\Alias\Data\Alias;
use Jstewmc\Gravity\Alias\Exception\NotFound as AliasNotFound;
use Jstewmc\Gravity\Deprecation\Data\Deprecation;
use Jstewmc\Gravity\Deprecation\Exception\NotFound as DeprecationNotFound;
use Jstewmc\Gravity\Id\Data\Id;
use Jstewmc\Gravity\Id\Data\Service as ServiceId;
use Jstewmc\Gravity\Id\Data\Setting as SettingId;
use Jstewmc\Gravity\Service\Data\Service;
use Jstewmc\Gravity\Service\Exception\NotFound as ServiceNotFound;
use Jstewmc\Gravity\Setting\Data\Setting;
use Jstewmc\Gravity\Setting\Exception\NotFound as SettingNotFound;

/**
 * A project has many aliases, deprecations, settings, and services
 *
 * @since  0.1.0
 */
class Project
{
    /* !Private properties */

    /**
     * @var    Alias[]  the project's aliases, indexed by identifier
     * @since  0.1.0
     */
    private $aliases = [];

    /**
     * @var    Deprecation[]  the project's deprecations, indexed by identifier
     * @since  0.1.0
     */
    private $deprecations = [];

    /**
     * @var    Service[]  the project's services, indexed by identifier
     * @since  0.1.0
     */
    private $services = [];

    /**
     * @var    mixed[]  the project's settings
     * @since  0.1.0
     */
    private $settings = [];


    /* !Public methods */

    /**
     * Adds an alias to the project
     *
     * @param   Alias  $alias  the alias to add
     * @return  self
     * @since   0.1.0
     */
    public function addAlias(Alias $alias): self
    {
        $this->aliases[(string)$alias->getSource()] = $alias;

        return $this;
    }

    /**
     * Adds a deprecation to the project
     *
     * @param   Deprecation  $deprecation  the deprecation to add
     * @return  self
     * @since   0.1.0
     */
    public function addDeprecation(Deprecation $deprecation): self
    {
        $this->deprecations[(string)$deprecation->getId()] = $deprecation;

        return $this;
    }

    /**
     * Adds a service to the project
     *
     * @param   Service  $service  the service to add
     * @return  self
     * @since   0.1.0
     */
    public function addService(Service $service): self
    {
        $this->services[(string)$service->getId()] = $service;

        return $this;
    }

    /**
     * Adds a setting to the project
     *
     * @param   Setting  $setting  the setting to add
     * @return  self
     * @since   0.1.0
     */
    public function addSetting(Setting $setting): self
    {
        $this->settings = uarray_merge_recursive(
            $this->settings,
            $setting->getArray()
        );

        return $this;
    }

    /**
     * Returns true if the project has an alias for $id
     *
     * @param   Id  $id  the identifier to test
     * @return  bool
     * @since   0.1.0
     */
    public function hasAlias(Id $id): bool
    {
        return array_key_exists((string)$id, $this->aliases);
    }

    /**
     * Returns true if the project has a deprecation for $id
     *
     * @param   Id  $id  the identifier to test
     * @return  bool
     * @since   0.1.0
     */
    public function hasDeprecation(Id $id): bool
    {
        return array_key_exists((string)$id, $this->deprecations);
    }

    /**
     * Returns true if the project has the service
     *
     * @param   Id  $id  the identifier to test
     * @return  bool
     * @since   0.1.0
     */
    public function hasService(Id $id): bool
    {
        return array_key_exists((string)$id, $this->services);
    }

    /**
     * Returns true if the project has the setting
     *
     * @param   Id  $id  the identifier to test
     * @return  bool
     * @since   0.1.0
     */
    public function hasSetting(Id $id): bool
    {
        $settings = $this->settings;

        foreach ($id->getSegments() as $segment) {
            if (!array_key_exists($segment, $settings)) {
                return false;
            }
            $settings = $settings[$segment];
        }

        return true;
    }

    /**
     * Returns the alias
     *
     * @param   Id  $id  the alias' identifier
     * @return  Alias
     * @throws  AliasNotFound  if $id is not an alias
     * @since   0.1.0
     */
    public function getAlias(Id $id): Alias
    {
        if (!$this->hasAlias($id)) {
            throw new AliasNotFound($id);
        }

        return $this->aliases[(string)$id];
    }

    /**
     * Returns the deprecation
     *
     * @param   Id  $id  the deprecation's identifier
     * @return  Deprecation
     * @throws  DeprecationNotFound  if $id is not a deprecation
     * @since   0.1.0
     */
    public function getDeprecation(Id $id): Deprecation
    {
        if (!$this->hasDeprecation($id)) {
            throw new DeprecationNotFound($id);
        }

        return $this->deprecations[(string)$id];
    }

    /**
     * Returns the service
     *
     * @param   ServiceId  $id  the identifier to test
     * @return  Service
     * @throws  ServiceNotFound  if $id is not a service
     * @since   0.1.0
     */
    public function getService(ServiceId $id): Service
    {
        if (!$this->hasService($id)) {
            throw new ServiceNotFound($id);
        }

        return $this->services[(string)$id];
    }

    /**
     * Returns the setting
     *
     * @param   SettingId  $id  the identifier to test
     * @return  mixed
     * @throws  SettingNotFound  if $id is not a setting
     * @since   0.1.0
     */
    public function getSetting(SettingId $id)
    {
        if (!$this->hasSetting($id)) {
            throw new SettingNotFound($id);
        }

        $settings = $this->settings;

        foreach ($id->getSegments() as $segment) {
            $settings = $settings[$segment];
        }

        return $settings;
    }
}
