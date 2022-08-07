<?php

declare(strict_types=1);

namespace Tests\HoGame\UseCase\User;

final class GetsOutputData
{
    private string $userId;
    private int $age;
    private string $name;

    public function __construct(string $userId, int $age, string $name)
    {
        $this->userId = $userId;
        $this->age = $age;
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            "userId" => $this->userId,
            "age" => $this->age,
            "name" => $this->name
        ];
    }
}
