[Home](index.md) | [Identifying](identifying.md) | [Setting](setting.md) | [Getting](getting.md) |  [**Aliasing**](aliasing.md) | [Deprecating](deprecating.md) | [Logging](logging.md) | [Caching](caching.md)

# Aliasing services and settings

An alias allows you to use a _different_ identifier for the _same_ service or setting.

In general, aliases should be used sparingly. It's a better world if every service and setting is identified by a single identifier!

Use the `$g->alias()` method to alias a setting, service, or alias. The method accepts two arguments: a _source id_ and a _destination id_.

```php
# /path/to/jstewmc/gravity/.gravity/aliasing.php

namespace Jstewmc\Gravity\Example;

// define a setting to alias
$g->set('jstewmc.gravity.example.aliasing.foo', true);

// define services to alias (using a fake namespace)
$g->set(Aliasing\Foo::class, function () {
    return new Service\Foo();
});

$g->set(Aliasing\Bar::class, function () {
    return new Service\Bar();
});

// alias the service
$g->alias(Aliasing\Foo::class, Aliasing\Bar::class);

// alias the ssetting
$g->alias(
    'jstewmc.gravity.example.aliasing.bar',
    'jstewmc.gravity.example.aliasing.foo'
);
```

When an alias is requested, it's equivalent to requesting the destination service or setting. The exact same object or value will be returned.

```php
# /path/to/jstewmc/gravity/examples/aliasing.php

namespace Jstewmc\Gravity\Example;

use Jstewmc\Gravity\Manager;

require_once realpath(__DIR__ . '/../vendor/autoload.php');

$g = new Manager();

$a = $g->get('jstewmc.gravity.example.aliasing.foo');
$b = $g->get('jstewmc.gravity.example.aliasing.bar');

assert($a == $b);

$c = $g->get(Aliasing\Foo::class);
$d = $g->get(Aliasing\Bar::class);

assert($c === $d);
```

Aliases can be chained, and Gravity will attempt to recursively resolve them. However, if you are chaining aliases, there is likely a better solution!

## That's it!

Next up, [deprecating services and setting](deprecating.md)!
