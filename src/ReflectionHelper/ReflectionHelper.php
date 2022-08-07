<?php

declare(strict_types=1);

namespace Ganyariya\Hako\ReflectionHelper;

use Ganyariya\Hako\Exception\TypeNotSpecifiedException;

final class ReflectionHelper
{
    /**
     * @throws TypeNotSpecifiedException
     */
    public static function getNameOfReflectionParameter(\ReflectionParameter $parameter): string
    {
        $type = $parameter->getType();
        return self::getNameByType($type, $parameter);
    }

    /**
     * @throws TypeNotSpecifiedException
     */
    public static function getNameByType(
        \ReflectionNamedType|\ReflectionUnionType|\ReflectionIntersectionType|null $type,
        \ReflectionParameter $parameter
    ): string {
        if (is_null($type)) {
            throw new TypeNotSpecifiedException(sprintf("A type of %s is not specified.", $parameter->getName()));
        }
        if ($type instanceof \ReflectionNamedType) {
            return $type->getName();
        }
        if ($type instanceof \ReflectionUnionType) {
            $types = $type->getTypes();
            return current($types)->getName();
        }
        if ($type instanceof \ReflectionIntersectionType) {
            $types = $type->getTypes();
            return self::getNameByType(current($types), $parameter);
        }
        return strval($type);
    }
}
