<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Fetcher;

use Ganyariya\Hako\Container\Container;

interface FetcherInterface
{
    public function fetch(Container $container): mixed;
}
