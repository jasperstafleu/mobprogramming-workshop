<?php

namespace DevelopersNL\Tests\Unit\Kernel;

use DevelopersNL\Kernel\Container;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @covers \DevelopersNL\Kernel\Container
 */
class ContainerTest extends TestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        $this->container = new Container;
    }

    public function testGetThrowsNotFoundExceptionInterfaceWhenServiceIdNotSet()
    {
        $this->expectException(NotFoundExceptionInterface::class);

        $this->container->get((string) mt_rand());
    }

    public function testGetThrowsContainerExceptionInterfaceWhenServiceConstructionThrowsException()
    {
        $serviceId = (string) mt_rand();
        $innerException = new \Exception('inner exception');
        $this->container->addServiceDefinition($serviceId, fn() => throw $innerException);

        $this->expectException(ContainerExceptionInterface::class);

        try {
            $this->container->get($serviceId);
        } catch (ContainerExceptionInterface $outerException) {
            $this->assertSame($innerException, $outerException->getPrevious());
            throw $outerException;
        }
    }

    public function testGetReturnsCorrectService()
    {
        $service = new class() {};
        $serviceId = (string) mt_rand();
        $this->container->addServiceDefinition($serviceId, fn() => $service);

        $this->assertSame($service, $this->container->get($serviceId));
    }
}
