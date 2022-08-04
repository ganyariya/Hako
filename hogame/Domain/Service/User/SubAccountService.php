<?php

declare(strict_types=1);

namespace HoGame\Domain\Service\User;

use HoGame\UseCase\Master\MasterRepositoryInterface;

final class SubAccountService
{
    private MasterRepositoryInterface $masterRepository;

    public function __construct(
        MasterRepositoryInterface $masterRepository
    ) {
        $this->masterRepository = $masterRepository;
    }
}
