<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Container;

use Ganyariya\Hako\Exception\ContainerException;
use Ganyariya\Hako\Fetcher\FetcherInterface;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function set(string $id, mixed $value): void
    {
        $this->data[$id] = $value;
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ContainerException("Not Found: $id");
        }
        $data = $this->data[$id];

        if (ContainerService::isContainerClosure($data)) {
            return $data($this);
        }

        return $data instanceof FetcherInterface
            ? $data->fetch($this)
            : $data;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }
}
