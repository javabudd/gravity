<?php
/**
 * @copyright  2018 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Gravity\Example;

// define a service using null
$g->set(Service\Baz::class);

// define a service using an instance
$g->set(Service\Qux::class, new Service\Qux());

// define a service using an anonymous function
$g->set(Service\Quux::class, function (): Service\Quux {
    return new Service\Quux();
});

// define a service with the same classname (and no arguments)
$g->set(Service\Quuz::class);

// inject other services
$g->set(Service\Corge::class, function (): Service\Corge {
    $quux = $this->get(Service\Quuz::class);

    return new Service\Corge($quux);
});

// define a service using a factory
$g->set(Factory\Grault::class);

$g->set(Service\Grault::class, Factory\Grault::class);

// you can use any PHP value as a setting
$g->set('jstewmc.gravity.example.setting.foo', true);
$g->set('jstewmc.gravity.example.setting.bar', 1);
$g->set('jstewmc.gravity.example.setting.baz', 'hello');
$g->set('jstewmc.gravity.example.setting.qux', [1, 2, 3]);

// the last scalar value wins
$g->set('jstewmc.gravity.example.setting.quux', 1);
$g->set('jstewmc.gravity.example.setting.quux', 2);

// on the other hand, arrays will be merged
$g->set('jstewmc.gravity.example.setting.quuz', ['corge']);
$g->set('jstewmc.gravity.example.setting.quuz', ['grault']);

// gravity will normalize settings of any length and depth
$g->set('jstewmc.gravity.example.setting.corge', [
    'garply' => [
        'waldo' => [
            'fred' => 1
        ]
    ]
]);
