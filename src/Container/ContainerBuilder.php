<?php

declare(strict_types=1);

namespace Ganyariya\Hako\Container;

final class ContainerBuilder
{
    /**
     * @var array<array<string, mixed>>
     */
    private array $definitions;

    public function __construct()
    {
        $this->definitions = [];
    }

    /**
     * @param array<string, mixed> $definitions
     */
    public function addDefinitions(array $definitions): void
    {
        $this->definitions[] = $definitions;
    }

    public function build(): Container
    {
        $container = new Container();
        foreach ($this->definitions as $definitions) {
            foreach ($definitions as $key => $value) {
                $container->set($key, $value);
            }
        }
        return $container;
    }
}
