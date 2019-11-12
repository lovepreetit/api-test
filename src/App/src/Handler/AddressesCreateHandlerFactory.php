<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class AddressesCreateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AddressesCreateHandler
    {
        $entityManager = $container->get(EntityManager::class);

        return new AddressesCreateHandler($entityManager);
    }
}
