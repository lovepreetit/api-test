<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class AddressesUpdateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AddressesUpdateHandler
    {
        $entityManager = $container->get(EntityManager::class);

        return new AddressesUpdateHandler($entityManager);
    }
}
