<?php

declare(strict_types=1);

namespace HoGame\Controller\User;

use HoGame\UseCase\User\GetsInputData;
use HoGame\UseCase\User\GetsInterface;

final class GetsController
{
    private GetsInterface $interactor;

    public function __construct(GetsInterface $interactor)
    {
        $this->interactor = $interactor;
    }

    // 本当は \Psr\RequestInterface 系を継承したもの
    public function __invoke(string $userId): array
    {
        $inputData = new GetsInputData(["userId" => $userId]);
        $response = $this->interactor->handle($inputData);
        // 本当は presenter を挟んだほうが良い
        return $response->toArray();
    }
}
