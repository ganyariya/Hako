<?php

declare(strict_types=1);

namespace HoGame\UseCase\User;

interface GetsInterface
{
    /**
     * @return GetsOutputData
     */
    public function handle(GetsInputData $inputData): GetsOutputData;
}
