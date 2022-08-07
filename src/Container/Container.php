<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Container;

use Ganyariya\Hako\Cache\Cache;
use Ganyariya\Hako\Dynamic\Loader;
use Ganyariya\Hako\Exception\ContainerException;
use Ganyariya\Hako\Fetcher\FetcherInterface;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array<string, Cache>
     */
    private array $data;

    private Loader $dynamicLoader;

    /**
     * @param mixed[] $data
     * @param Loader $dynamicLoader
     */
    public function __construct(array $data = [], Loader $dynamicLoader = new Loader())
    {
        $this->data = $data;
        $this->dynamicLoader = $dynamicLoader;
    }

    public function set(string $id, mixed $value): void
    {
        $this->data[$id] = new Cache($value);
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            if ($this->dynamicLoader->existsDeclaredClass($id)) {
                $loaded = $this->dynamicLoader->load($this, $id);
                return $loaded->getResolvedData();
            }
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
