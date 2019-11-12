<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class AddressesDeleteHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AddressesDeleteHandler
    {
        $entityManager = $container->get(EntityManager::class);

        return new AddressesDeleteHandler($entityManager);
    }
}
