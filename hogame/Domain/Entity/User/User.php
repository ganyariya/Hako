<?php

declare(strict_types=1);

namespace HoGame\Domain\Entity\User;

final class User
{
    private string $userId;
    private string $name;
    private int $age;

    public function __construct(string $userId, string $name, int $age)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->age = $age;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
