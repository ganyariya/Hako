<?php

declare(strict_types=1);

namespace Ganyariya\Hako;

use Ganyariya\Hako\Fetcher\Fetcher;
use Ganyariya\Hako\Fetcher\FetcherInterface;

if (!function_exists('Ganyariya\Hako\fetch')) {
    function fetch(string $id): FetcherInterface
    {
        return new Fetcher($id);
    }
}
