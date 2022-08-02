<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Container;

use Ganyariya\Hako\Cache\Cache;
use Ganyariya\Hako\Exception\ContainerException;
use Ganyariya\Hako\Fetcher\FetcherInterface;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array<string, Cache>
     */
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function set(string $id, mixed $value): void
    {
        $this->data[$id] = new Cache($value);
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ContainerException("Not Found: $id");
        }
        $cache = $this->data[$id];
        if ($cache->isResolved()) {
            return $cache->getResolvedData();
        }

        $actual = $cache->getActualData();
        if (ContainerService::isContainerClosure($actual)) {
            /** @var \Closure $actual */
            $resolved = $actual($this);
            $cache->cache($resolved);
            return $resolved;
        }

        if ($actual instanceof FetcherInterface) {
            $resolved = $actual->fetch($this);
            $cache->cache($resolved);
            return $resolved;
        } else {
            $cache->cache($actual);
            return $actual;
        }
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }
}
