<?php
/**
 * The file for a setting identifier
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Id\Data;

use Jstewmc\Gravity\Path\Data\Setting as Path;

/**
 * A setting identifier
 *
 * @since  0.1.0
 */
class Setting extends Id
{
    /* !Magic methods */

    /**
     * Called when the id is constructed
     *
     * @param  Path  $path
     * @since  0.1.0
     */
    public function __construct(Path $path)
    {
        parent::__construct($path);
    }
}
