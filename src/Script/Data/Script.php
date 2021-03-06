<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Script\Data;

abstract class Script
{
    protected $aliases = [];

    protected $definitions = [];

    protected $deprecations = [];

    protected $requirements = [];

    public function getAliases(): array
    {
        return $this->aliases;
    }

    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    public function getDeprecations(): array
    {
        return $this->deprecations;
    }

    public function getRequirements(): array
    {
        return $this->requirements;
    }

    public function setAliases(array $aliases): self
    {
        $this->aliases = $aliases;

        return $this;
    }

    public function setDefinitions(array $definitions): self
    {
        $this->definitions = $definitions;

        return $this;
    }

    public function setDeprecations(array $deprecations): self
    {
        $this->deprecations = $deprecations;

        return $this;
    }

    public function setRequirements(array $requirements): self
    {
        $this->requirements = $requirements;
        
        return $this;
    }
}
