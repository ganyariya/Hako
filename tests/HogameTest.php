<?php

declare(strict_types=1);

namespace Tests;

use Ganyariya\Hako;
use Ganyariya\Hako\Container\Container;
use Ganyariya\Hako\Container\ContainerBuilder;
use HoGame\Controller\User\GetsController;
use HoGame\Domain\Application\User\GetsInteractor;
use HoGame\Domain\Service\User\AccountService;
use HoGame\Domain\Service\User\SubAccountService;
use HoGame\Repository\Spanner\MasterRepository;
use HoGame\Repository\Spanner\UserRepository;
use HoGame\UseCase\Master\MasterRepositoryInterface;
use HoGame\UseCase\User\GetsInterface;
use HoGame\UseCase\User\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class HoGameTest extends TestCase
{
    public function testContainerClosure(): void
    {
        $container = new Container();

        $container->set(GetsController::class, function (ContainerInterface $c) {
            return new GetsController(
                $c->get(GetsInterface::class)
            );
        });
        $container->set(GetsInterface::class, function (ContainerInterface $c) {
            return new GetsInteractor(
                $c->get(UserRepositoryInterface::class),
                $c->get(MasterRepositoryInterface::class),
                $c->get(AccountService::class)
            );
        });
        $container->set(AccountService::class, function (ContainerInterface $c) {
            return new AccountService(
                $c->get(MasterRepositoryInterface::class),
                $c->get(SubAccountService::class)
            );
        });
        $container->set(SubAccountService::class, function (ContainerInterface $c) {
            return new SubAccountService(
                $c->get(MasterRepositoryInterface::class)
            );
        });
        $container->set(MasterRepositoryInterface::class, function (ContainerInterface $c) {
            return new MasterRepository();
        });
        $container->set(UserRepositoryInterface::class, function (ContainerInterface $c) {
            return new UserRepository();
        });

        $userId = $expectedUserId = "Test";
        $expectedName = "StubName";
        $expectedAge = 25;

        /** @var GetsController $controller */
        $controller = $container->get(GetsController::class);
        $array = $controller($userId);

        $this->assertSame($expectedUserId, $array["userId"]);
        $this->assertSame($expectedName, $array["name"]);
        $this->assertSame($expectedAge, $array["age"]);
        $this->assertTrue(true);
    }

    public function testLoader(): void
    {

        $container = new Container();

        $container->set(GetsInterface::class, Hako\fetch(GetsInteractor::class));
        $container->set(MasterRepositoryInterface::class, Hako\fetch(MasterRepository::class));
        $container->set(UserRepositoryInterface::class, Hako\fetch(UserRepository::class));

        $userId = $expectedUserId = "Test";
        $expectedName = "StubName";
        $expectedAge = 25;

        /** @var GetsController $controller */
        $controller = $container->get(GetsController::class);
        $array = $controller($userId);

        $this->assertSame($expectedUserId, $array["userId"]);
        $this->assertSame($expectedName, $array["name"]);
        $this->assertSame($expectedAge, $array["age"]);
    }

    public function testContainerBuilder(): void
    {

        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            GetsInterface::class => Hako\fetch(GetsInteractor::class),
            MasterRepositoryInterface::class => Hako\fetch(MasterRepository::class),
            UserRepositoryInterface::class => Hako\fetch(UserRepository::class)
        ]);

        $container = $builder->build();

        $userId = $expectedUserId = "Test";
        $expectedName = "StubName";
        $expectedAge = 25;

        /** @var GetsController $controller */
        $controller = $container->get(GetsController::class);
        $array = $controller($userId);

        $this->assertSame($expectedUserId, $array["userId"]);
        $this->assertSame($expectedName, $array["name"]);
        $this->assertSame($expectedAge, $array["age"]);
    }
}
