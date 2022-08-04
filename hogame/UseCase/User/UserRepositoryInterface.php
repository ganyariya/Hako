<?php

declare(strict_types=1);

namespace HoGame\UseCase\User;

use HoGame\Domain\Entity\User\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    public function findByPrimaryId(string $userId): User;
}
