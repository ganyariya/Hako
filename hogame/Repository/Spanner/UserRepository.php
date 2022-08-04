<?php

declare(strict_types=1);

namespace HoGame\Repository\Spanner;

use HoGame\Domain\Entity\User\User;
use HoGame\UseCase\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findAll(): array
    {
        return [];
    }

    public function findByPrimaryId(string $userId): User
    {
        /**
         * Spanner 接続処理 でアレコレする
         */
        $testName = "StubName";
        $testAge = 25;
        return new User($userId, $testName, $testAge);
    }
}
