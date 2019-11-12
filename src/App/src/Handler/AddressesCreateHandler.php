<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class AddressesCreateHandler implements RequestHandlerInterface
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

        $user = $entityRepository->find($requestData['user_id']);

        if (empty($user)) {
            return new JsonResponse([
                'status' => "error",
                'message' => "User not found."
            ], 404);
        }

        $address = new Address();

        try {

            $address->setUser($user);

            $address->setCity($requestData['city']);
            $address->setState($requestData['state']);
            $address->setPin($requestData['pin']);

            $this->entityManager->persist($address);
            $this->entityManager->flush();

        } catch (ORMException $e) {
            $jsonResponse['status'] = "error";
            $jsonResponse['message'] = $e->getMessage();
            return new JsonResponse($jsonResponse, 400);

        }

        $jsonResponse['status'] = "success";
        $jsonResponse['message'] = "Address Saved.";

        return new JsonResponse($jsonResponse);
    }
}
