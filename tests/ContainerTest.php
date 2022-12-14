<?php

declare(strict_types=1);

namespace Tests;

use Tests\VTuber\NijisanjiVTuber;
use Tests\VTuber\VTuberInterface;
use Ganyariya\Hako;
use Ganyariya\Hako\Container\Container;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ContainerTest extends TestCase
{

    public function testContainerSet(): void
    {
        $container = new Container();
        $container->set("hello", "world!");
        $container->set("Hello", "World!");

        $this->assertSame("world!", $container->get("hello"));
        $this->assertSame("world!", $container->get("hello"));
    }

    public function testCache(): void
    {
        $container = new Container();
        $container->set(VTuberInterface::class, function (ContainerInterface $c) {
            return new NijisanjiVTuber("uduki");
        });
        $container->set("b", Hako\fetch(VTuberInterface::class));

        $this->assertSame("uduki", $container->get(VTuberInterface::class)->getName());
        $this->assertSame("uduki", $container->get("b")->getName());
        $this->assertTrue($container->get(VTuberInterface::class) === $container->get("b"));
    }

    public function testContainerClosure(): void
    {
        $container = new Container();
        $container->set("UDK", "Kou");
        $container->set(VTuberInterface::class, function (ContainerInterface $c) {
            $name = $c->get("UDK");
            return new NijisanjiVTuber($name);
        });

        $this->assertSame("Kou", $container->get(VTuberInterface::class)->getName());
    }

    public function testFetcher(): void
    {
        $container = new Container();
        $container->set(VTuberInterface::class, new NijisanjiVTuber("uduki"));
        $container->set("UDK", Hako\fetch(VTuberInterface::class));
        $this->assertSame("uduki", $container->get("UDK")->getName());
    }

    public function testContainerInterfaceToObject(): void
    {
        $container = new Container();
        $container->set(VTuberInterface::class, new NijisanjiVTuber("uduki"));
        /** @var NijisanjiVTuber $uduki */
        $uduki = $container->get(VTuberInterface::class);
        $this->assertInstanceOf(VTuberInterface::class, $uduki);
        $this->assertSame("uduki", $uduki->getName());
    }

    // public function testNotFound(): void
    // {
    //     $container = new Container();
    //     $this->expectException(ContainerException::class);
    //     $container->get("NotFound");
    // }
}
