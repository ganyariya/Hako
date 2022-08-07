
## 📦 Hako 

A super simple DI Container 📦 of PHP (based on PSR-11).

## 📦 How to Install 

```shell
composer require ganyariya/hako
```

## 📦 Example

The detail example can be seen in [tests](./tests/).

### Set / Get

```php
<?php

use Ganyariya\Hako;
use Ganyariya\Hako\Container\Container;
use Psr\Container\ContainerInterface;

/**
 * Suppose that your some interface and class are already defined.
 * For example, Your UserRepositoryInterface, UserRepository, MasterRepositoryInterface, and MasterRepository are defined.
 */

$container = new Container();

$container->set("Hello", "world!");

// Pattern1: Hako\fetch can automatically resolve dependencies using builtin \Reflection.
$container->set(UserRepositoryInterface::class, Hako\fetch(UserRepository::class));
$container->set(MasterRepositoryInterface::class, Hako\fetch(MasterRepository::class));

// Pattern2: Self Injection
$container->set(UserRepositoryInterface::class, function(ContainerInterface $c) {
    return new UserRepository(
        $c->get(MasterRepositoryInterface::class);
    );
});

assert($container->get("Hello") === "world!");
assert($container->get(UserRepositoryInterface::class) instanceof UserRepository);

/**
 * After setting up the Container, pass the Container to a WebFramework such as Slim or Laravel.
 * https://www.slimframework.com/docs/v4/concepts/di.html
 * /
```


### Container Builder

```php
<?php

use Ganyariya\Hako;
use Ganyariya\Hako\Container\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    GetsInterface::class => Hako\fetch(GetsInteractor::class),
    MasterRepositoryInterface::class => Hako\fetch(MasterRepository::class),
]);
$builder->addDefinitions([
    UserRepositoryInterface::class => Hako\fetch(UserRepository::class)
]);

// From definitions, create container.
$container = $builder->build();

/** @var GetsController $controller */
$controller = $container->get(GetsController::class);

/**
 * After setting up the Container, pass the Container to a WebFramework such as Slim or Laravel.
 * https://www.slimframework.com/docs/v4/concepts/di.html
 * /
```

