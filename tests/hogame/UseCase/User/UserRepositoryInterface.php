<?php

declare(strict_types=1);

namespace Tests\HoGame\UseCase\User;

use Tests\HoGame\Domain\Entity\User\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    public function findByPrimaryId(string $userId): User;
}
