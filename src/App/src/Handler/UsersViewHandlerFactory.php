<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UsersViewHandlerFactory
{
    public function __invoke(ContainerInterface $container): UsersViewHandler
    {
        $entityManager = $container->get(EntityManager::class);

        $entityRepository = $entityManager->getRepository(User::class);

        return new UsersViewHandler($entityRepository);
    }
}
