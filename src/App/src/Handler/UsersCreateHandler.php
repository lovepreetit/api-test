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

class UsersCreateHandler implements RequestHandlerInterface
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

        $user = new User();
        try {
            $user->setName($requestData['name']);
            $user->setAge((int)$requestData['age']);
            $user->setEmail($requestData['email']);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

        } catch (ORMException $e) {
            $jsonResponse['status'] = "error";
            $jsonResponse['message'] = $e->getMessage();
            return new JsonResponse($jsonResponse, 400);

        }

        $jsonResponse['status'] = "success";
        $jsonResponse['message'] = "User Saved.";

        return new JsonResponse($jsonResponse);
    }
}
