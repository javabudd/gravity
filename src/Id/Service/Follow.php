<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Id\Service;

use Jstewmc\Gravity\Deprecation\Service\Warn as WarnDeprecation;
use Jstewmc\Gravity\Id\Data\Id;
use Jstewmc\Gravity\Project\Data\Project;

class Follow
{
    private $warnDeprecation;

    public function __construct(WarnDeprecation $warnDeprecation)
    {
        $this->warnDeprecation = $warnDeprecation;
    }

    public function __invoke(Id $id, Project $project): Id
    {
        // trigger deprecations now or never
        if ($project->hasDeprecation($id)) {
            ($this->warnDeprecation)($project->getDeprecation($id));
        }

        if ($project->hasAlias($id)) {
            $destination = $project->getAlias($id)->getDestination();
            $id = ($this)($destination, $project);
        }

        return $id;
    }
}
