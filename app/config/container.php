<?php

use DevelopersNL\Kernel\Container;

$container = new Container();
$container
    ->addServiceDefinition(
        \PDO::class,
        function() {
            static $pdo; // Singleton instance pls. If you need more connections, add more services to this container!
            return $pdo ??= new \PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        }
    )
    ->addServiceDefinition(
        \DevelopersNL\Model\PostgresRepository::class,
        fn() => new \DevelopersNL\Model\PostgresRepository($container->get(\PDO::class), 'users')
    )
    ->addServiceDefinition(
        \DevelopersNL\Controller\RegisterController::class,
        fn() => new \DevelopersNL\Controller\RegisterController($container->get(\DevelopersNL\Model\PostgresRepository::class))
    )
;

return $container;
