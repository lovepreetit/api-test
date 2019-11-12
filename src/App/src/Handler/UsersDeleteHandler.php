<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class UsersDeleteHandler implements RequestHandlerInterface
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $jsonResponse = [];
        $entityRepository = $this->entityManager->getRepository(User::class);
        $user = $entityRepository->find($request->getAttribute('id'));

        if (empty($user)) {
            return new JsonResponse([
                'status' => "error",
                'message' => "User not found."
            ], 404);
        }

        try {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $jsonResponse['status'] = "error";
            $jsonResponse['message'] = $e->getMessage();
            return new JsonResponse($jsonResponse, 400);
        }

        $jsonResponse['status'] = "success";
        $jsonResponse['message'] = "User Deleted.";

        return new JsonResponse($jsonResponse);
    }
}
