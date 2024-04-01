<?php

namespace vendor\src\Core;

class Container
{
    private array $services = [];

    public function __construct(array $services)
    {
        $this->services = $services;
    }

    public function set(string $className, callable $callback): void
    {
        $this->services[$className] = $callback;

    }

    public function get(string $className): object
    {
        if (isset($this->services[$className])) {
            $callback = $this->services[$className];
            return $callback($this);
        }

        return new $className();

    }

}