<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class AddressesReadHandler implements RequestHandlerInterface
{
    protected $entityRepository;


    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $addresses = $this->entityRepository->findBy([
            'user_id' => $request->getAttribute('user_id')
        ]);

        return new JsonResponse([
            'addresses' => $addresses
        ]);
    }
}
