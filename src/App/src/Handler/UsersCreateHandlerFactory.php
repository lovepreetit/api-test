<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UsersCreateHandlerFactory
{
    public function __invoke(ContainerInterface $container): UsersCreateHandler
    {

        $entityManager = $container->get(EntityManager::class);

        return new UsersCreateHandler($entityManager);
    }
}
