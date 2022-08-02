<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Container\Wrapper;

use Ganyariya\Hako\Fetcher\Fetcher;
use Ganyariya\Hako\Fetcher\FetcherInterface;

function fetch(string $id): FetcherInterface
{
    return new Fetcher($id);
}
