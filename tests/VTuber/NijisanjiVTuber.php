<?php

namespace Tests\VTuber;

class NijisanjiVTuber implements VTuberInterface
{
    private string $name;
    private int $age;

    public function __construct(string $name, int $age = 27)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGroup(): string
    {
        return "Nijisanji";
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
