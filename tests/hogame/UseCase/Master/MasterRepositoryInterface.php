<?php

declare(strict_types=1);

namespace Tests\HoGame\UseCase\Master;

use Tests\HoGame\Domain\Entity\Master\MasterInterface;

interface MasterRepositoryInterface
{
    /**
     * @return MasterInterface[]
     */
    public function findAll(): array;

    public function findByPrimaryId(int $id): ?MasterInterface;
}
