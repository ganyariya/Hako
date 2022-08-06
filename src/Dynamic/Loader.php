<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Dynamic;

use Ganyariya\Hako\Cache\Cache;
use Psr\Container\ContainerInterface;

final class Loader
{
    public function existsDeclaredClass(string $id): bool
    {
        $declaredClasses = get_declared_classes();
        return in_array($id, $declaredClasses, true);
    }

    public function load(ContainerInterface $container, string $id): mixed
    {
        $class = new \ReflectionClass($id);
        $constructor = $class->getConstructor();
        $parameters = $constructor->getParameters();
        $arguments = array_map(fn (\ReflectionParameter $r) => $container->get($r->getType()->getName()), $parameters);

        $generated = new $id(...$arguments);
        $cache = new Cache($generated);
        $cache->cache($generated);
        return $cache;
    }
}
