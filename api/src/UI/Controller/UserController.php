<?php

declare(strict_types=1);

namespace App\UI\Controller;

use App\Application\Dto\UserDto;
use App\Application\Requests\CreateUserRequest;
use App\Application\UseCases\CreateUserUseCase;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private CreateUserUseCase $createUserUseCase;

    private UserRepositoryInterface $userRepository;

    public function __construct(CreateUserUseCase $createUserUseCase, UserRepositoryInterface $userRepository)
    {
        $this->createUserUseCase = $createUserUseCase;
        $this->userRepository = $userRepository;
    }

    #[Route('/api/users', methods: ['GET', 'OPTIONS'])]
    public function getUsers(): JsonResponse
    {
        $users = $this->userRepository->getUsers();
        $userDtos = array_map(fn($user) => UserDto::fromEntity($user), $users);
        return $this->json($userDtos);
    }

    #[Route('/api/users', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'])) {
            return new JsonResponse(['error' => 'Missing name field'], 400);
        }

        $userRequest = new CreateUserRequest($data['name']);

        $userResponse = $this->createUserUseCase->execute($userRequest);

        return $this->json($userResponse->getUser());
    }
}
