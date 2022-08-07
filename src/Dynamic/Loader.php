<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Dynamic;

use Ganyariya\Hako\Cache\Cache;
use Ganyariya\Hako\ReflectionHelper\ReflectionHelper;
use Psr\Container\ContainerInterface;

final class Loader
{
    public function existsDeclaredClass(string $id): bool
    {
        $declaredClasses = get_declared_classes();
        return in_array($id, $declaredClasses, true) || class_exists($id, true);
    }

    public function load(ContainerInterface $container, string $id): mixed
    {
        $class = new \ReflectionClass($id);
        $constructor = $class->getConstructor();
        $arguments = [];
        if (!is_null($constructor)) {
            $parameters = $constructor->getParameters();
            $names = array_map(
                fn (\ReflectionParameter $rp) => ReflectionHelper::getNameOfReflectionParameter($rp),
                $parameters
            );
            $arguments = array_map(fn (string $name) => $container->get($name), $names);
        }
        $generated = new $id(...$arguments);
        $cache = new Cache($generated);
        $cache->cache($generated);
        return $cache;
    }
}
