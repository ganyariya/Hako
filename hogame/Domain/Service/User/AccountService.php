<?php

declare(strict_types=1);

namespace HoGame\Domain\Service\User;

use HoGame\UseCase\Master\MasterRepositoryInterface;

final class AccountService
{
    private MasterRepositoryInterface $masterRepository;
    private SubAccountService $subAccountService;

    public function __construct(
        MasterRepositoryInterface $masterRepository,
        SubAccountService $subAccountService
    ) {
        $this->masterRepository = $masterRepository;
        $this->subAccountService = $subAccountService;
    }
}
