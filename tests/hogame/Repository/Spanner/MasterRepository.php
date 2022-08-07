<?php

declare(strict_types=1);

namespace Tests\HoGame\Repository\Spanner;

use Tests\HoGame\Domain\Entity\Master\MasterInterface;
use Tests\HoGame\UseCase\Master\MasterRepositoryInterface;

final class MasterRepository implements MasterRepositoryInterface
{
    public function findAll(): array
    {
        return [];
    }

    public function findByPrimaryId(int $id): ?MasterInterface
    {
        return null;
    }
}
