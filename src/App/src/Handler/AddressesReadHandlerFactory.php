<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Address;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class AddressesReadHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AddressesReadHandler
    {
        $entityManager = $container->get(EntityManager::class);

        $entityRepository = $entityManager->getRepository(Address::class);

        return new AddressesReadHandler($entityRepository);
    }
}
