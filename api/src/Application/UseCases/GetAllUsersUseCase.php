<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Domain\Repository\UserRepositoryInterface;

class GetAllUsersUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->getUsers();
    }
}
