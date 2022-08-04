<?php

declare(strict_types=1);

namespace HoGame\Repository\Spanner;

use HoGame\Domain\Entity\Master\MasterInterface;
use HoGame\UseCase\Master\MasterRepositoryInterface;

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
