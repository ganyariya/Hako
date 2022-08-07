<?php

declare(strict_types=1);

namespace Tests\HoGame\Domain\Application\User;

use Tests\HoGame\Domain\Service\User\AccountService;
use Tests\HoGame\UseCase\Master\MasterRepositoryInterface;
use Tests\HoGame\UseCase\User\GetsInputData;
use Tests\HoGame\UseCase\User\GetsInterface;
use Tests\HoGame\UseCase\User\GetsOutputData;
use Tests\HoGame\UseCase\User\UserRepositoryInterface;

final class GetsInteractor implements GetsInterface
{
    private UserRepositoryInterface $userRepository;
    private MasterRepositoryInterface $masterRepository;
    private AccountService $accountService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        MasterRepositoryInterface $masterRepository,
        AccountService $accountService
    ) {
        $this->userRepository = $userRepository;
        $this->masterRepository = $masterRepository;
        $this->accountService = $accountService;
    }

    public function handle(GetsInputData $inputData): GetsOutputData
    {
        $userId = $inputData->getUserId();
        $user = $this->userRepository->findByPrimaryId($userId);
        return new GetsOutputData(
            $userId,
            $user->getAge(),
            $user->getName()
        );
    }
}
