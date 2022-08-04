<?php

declare(strict_types=1);

namespace HoGame\UseCase\User;

final class GetsInputData
{
    private string $userId;

    public function __construct(array $data)
    {
        $this->userId = $data["userId"];
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
