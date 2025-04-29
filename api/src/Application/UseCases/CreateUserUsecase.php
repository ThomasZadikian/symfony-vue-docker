<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\Requests\CreateUserRequest;
use App\Application\Responses\CreateUserResponse;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

class CreateUserUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        $newUser = new User($request->getName());
        $this->userRepository->saveUser($newUser);
        return new CreateUserResponse($newUser);
    }
}
