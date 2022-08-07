<?php

declare(strict_types=1);

namespace Tests\HoGame\Controller\User;

use Tests\HoGame\UseCase\User\GetsInputData;
use Tests\HoGame\UseCase\User\GetsInterface;

final class GetsController
{
    private GetsInterface $interactor;

    public function __construct(GetsInterface $interactor)
    {
        $this->interactor = $interactor;
    }

    /**
     * @param string $userId
     * @return mixed[]
     */
    public function __invoke(string $userId): array
    {
        $inputData = new GetsInputData(["userId" => $userId]);
        $response = $this->interactor->handle($inputData);
        return $response->toArray();
    }
}
