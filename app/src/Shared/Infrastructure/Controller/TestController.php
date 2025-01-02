<?php

namespace App\Shared\Infrastructure\Controller;

use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/test', methods: ['GET'])]

class TestController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(Connection $connection): Response
    {
        try {

            $user = new UserFactory()->create('asdasd@gmail.com','122312');

            //act
            $this->userRepository->add($user);
            return new JsonResponse(['status' => 'ok']);
        } catch (\Exception $e) {
            return new JsonResponse(['Error' => $e->getMessage()]);
        }
    }
}