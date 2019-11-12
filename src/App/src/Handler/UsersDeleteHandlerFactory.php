<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UsersDeleteHandlerFactory
{
    public function __invoke(ContainerInterface $container) : UsersDeleteHandler
    {
        $entityManager = $container->get(EntityManager::class);

        return new UsersDeleteHandler($entityManager);
    }
}
