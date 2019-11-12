<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UsersUpdateHandlerFactory
{
    public function __invoke(ContainerInterface $container): UsersUpdateHandler
    {
        $entityManager = $container->get(EntityManager::class);

        return new UsersUpdateHandler($entityManager);
    }
}
