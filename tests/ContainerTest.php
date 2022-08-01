<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Tests;

use Ganyariya\Hako\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function testContainer(): void
    {
        $container = new Container();
        $this->assertInstanceOf(Container::class, $container);
    }
}
