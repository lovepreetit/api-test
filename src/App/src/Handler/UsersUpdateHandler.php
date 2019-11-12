<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class UsersUpdateHandler implements RequestHandlerInterface
{
    protected $entityManager;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $jsonResponse = [];
        $requestData = $request->getParsedBody();

        if (empty($requestData)) {
            $jsonResponse['status'] = "error";
            $jsonResponse['message'] = "Invalid data.";
            return new JsonResponse($jsonResponse, 400);
        }

        $entityRepository = $this->entityManager->getRepository(User::class);

        $user = $entityRepository->find($request->getAttribute('id'));

        if (empty($user)) {
            return new JsonResponse([
                'status' => "error",
                'message' => "User not found."
            ], 404);
        }

        try {
            $user->setName($requestData['name']);
            $user->setAge((int)$requestData['age']);
            $user->setEmail($requestData['email']);

            $this->entityManager->merge($user);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $jsonResponse['status'] = "error";
            $jsonResponse['message'] = $e->getMessage();
            return new JsonResponse($jsonResponse, 400);
        }

        $jsonResponse['status'] = "success";
        $jsonResponse['message'] = "User Updated.";

        return new JsonResponse($jsonResponse);
    }
}
