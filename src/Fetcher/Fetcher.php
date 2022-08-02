<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Fetcher;

use Ganyariya\Hako\Container\Container;

class Fetcher implements FetcherInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function fetch(Container $container): mixed
    {
        return $container->get($this->id);
    }
}
