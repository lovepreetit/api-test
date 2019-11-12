<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class UserReadHandler implements RequestHandlerInterface
{
    protected $entityRepository;


    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $query = $this->entityRepository->createQueryBuilder('c')
            ->getQuery();

        return new JsonResponse([
            'users' => $query->getResult()
        ]);
    }
}
