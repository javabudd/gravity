<?php

namespace Jstewmc\Gravity\Example;

use Jstewmc\Gravity\Manager;

require_once realpath(__DIR__ . '/../vendor/autoload.php');

$g = new Manager();

// using the settings from ../.gravity/examples/setting.php:31
$expected = true;
$actual   = $g->get('jstewmc.gravity.example.setting.foo');

assert($expected == $actual);

// using the settings from ../.gravity/examples/setting.php:12
$instance = $g->get(Setting\Qux::class);

assert($instance instanceof Service\Qux);

$a = $g->get(Setting\Qux::class);
$b = $g->get(Setting\Qux::class);

// remember, PHP's === operator compares the object's references in memory
assert($a === $b);