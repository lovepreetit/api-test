<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UserReadHandlerFactory
{
    public function __invoke(ContainerInterface $container): UserReadHandler
    {
        $entityManager = $container->get(EntityManager::class);

        $entityRepository = $entityManager->getRepository(User::class);

        return new UserReadHandler($entityRepository);
    }
}
