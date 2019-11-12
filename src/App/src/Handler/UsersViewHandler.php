<?php

declare(strict_types=1);

namespace App\Handler;

use Doctrine\ORM\EntityRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class UsersViewHandler implements RequestHandlerInterface
{
    protected $entityRepository;


    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $user = $this->entityRepository->find($request->getAttribute('id'));

        if (empty($user)) {
            return new JsonResponse([
                'status' => "error",
                'message' => "User not found."
            ], 404);
        }

        return new JsonResponse([
            'status' => "success",
            'message' => "User found.",
            'user' => $user
        ]);
    }
}
