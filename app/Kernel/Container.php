<?php

namespace DevelopersNL\Kernel;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    /** @var callable[] */
    protected array $factories = [];

    public function addServiceDefinition(string $id, callable $factory): self
    {
        $this->factories[$id] = $factory;

        return $this;
    }

    public function get(string $id): object
    {
        if (!$this->has($id)) {
            throw new class('Service ' . $id . ' not found') extends \OutOfBoundsException implements NotFoundExceptionInterface {};
        }

        try {
            return $this->factories[$id]();
        } catch (\Exception $e) {
            throw new class(
                message: 'Service ' . $id . ' factory throws error ' . $e->getMessage(),
                previous: $e
            ) extends \BadMethodCallException implements ContainerExceptionInterface {};
        }
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->factories);
    }
}
