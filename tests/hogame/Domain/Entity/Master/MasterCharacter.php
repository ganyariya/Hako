<?php

declare(strict_types=1);

namespace Tests\HoGame\Domain\Entity\Master;

final class MasterCharacter implements MasterInterface
{
    private int $masterCharacterId;
    private string $name;
    private int $hp;

    public function __construct(int $masterCharacterId, string $name, int $hp)
    {
        $this->masterCharacterId = $masterCharacterId;
        $this->name = $name;
        $this->hp = $hp;
    }

    public function getMasterCharacterId(): int
    {
        return $this->masterCharacterId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHp(): int
    {
        return $this->hp;
    }
}
