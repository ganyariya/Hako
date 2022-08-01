<?php

declare(strict_types=1);

namespace Ganyariya\Hako;

use ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ContainerException("Not Found: $id");
        }
        return $this->data[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }
}
