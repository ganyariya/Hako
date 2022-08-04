<?php

namespace Tests\VTuber;

class NijisanjiVTuber implements VTuberInterface
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGroup(): string
    {
        return "Nijisanji";
    }
}
