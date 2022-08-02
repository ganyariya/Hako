<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Container;

use Psr\Container\ContainerInterface;

class ContainerService
{
    /**
     * $container->set(A::class => function (ContainerInterface $c) {
     *   return new B($c->get("C"));
     * }})
     */
    public static function isContainerClosure(mixed $data): bool
    {
        if (!($data instanceof \Closure)) {
            return false;
        }

        $refFun = new \ReflectionFunction($data);
        $parameters = $refFun->getParameters();
        if (count($parameters) !== 1) {
            return false;
        }

        $parameter = current($parameters);
        $typeName = $parameter->getType()->getName();
        return $typeName === ContainerInterface::class;
    }
}
