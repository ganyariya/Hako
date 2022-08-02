<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Cache;

class Cache
{
    private mixed $actualData;
    private mixed $resolvedData;
    private bool $resolved;

    public function __construct(mixed $data)
    {
        $this->actualData = $data;
        $this->resolvedData = null;
        $this->resolved = false;
    }

    public function cache(mixed $resolvedData): void
    {
        $this->resolved = true;
        $this->resolvedData = $resolvedData;
    }

    public function isResolved(): bool
    {
        return $this->resolved;
    }

    public function getActualData(): mixed
    {
        return $this->actualData;
    }

    public function getResolvedData(): mixed
    {
        return $this->resolvedData;
    }
}
