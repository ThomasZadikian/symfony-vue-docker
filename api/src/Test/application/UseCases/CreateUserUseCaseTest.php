<?php

declare(strict_types=1);

namespace App\Tests\UseCases;

use App\Application\Requests\CreateUserRequest;
use App\Application\Responses\CreateUserResponse;
use App\Application\UseCases\CreateUserUseCase;
use App\Domain\Entity\User;
use App\Infrastructure\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    public function testExecuteCreatesNewUserWhenNoUsersExist(): void
    {
        $UserRepositoryMock = $this->createMock(UserRepository::class);

        $UserRepositoryMock->expects($this->once())
            ->method('getUsers')
            ->willReturn([]);

        $UserRepositoryMock->expects($this->once())
            ->method('saveUser')
            ->with($this->callback(function ($user) {
                return $user instanceof User
                    && $user->getId() === 1
                    && $user->getName() === 'John Doe';
            }));

        $useCase = new CreateUserUseCase($UserRepositoryMock);
        $request = new CreateUserRequest('John Doe');

        // Act
        $response = $useCase->execute($request);

        // Assert
        $this->assertInstanceOf(CreateUserResponse::class, $response);

        $user = $response->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(1, $user->getId());
        $this->assertSame('John Doe', $user->getName());
    }

    public function testExecuteCreatesNewUserWhenUsersExist(): void
    {
        $existingUser = new User(1, 'Alice');
        $UserRepositoryMock = $this->createMock(UserRepository::class);

        $UserRepositoryMock->expects($this->once())
            ->method('getUsers')
            ->willReturn([$existingUser]);

        $UserRepositoryMock->expects($this->once())
            ->method('saveUser')
            ->with($this->callback(function ($user) {
                return $user instanceof User
                    && $user->getId() === 2;
            }));

        $useCase = new CreateUserUseCase($UserRepositoryMock);
        $request = new CreateUserRequest('Bob');

        // Act
        $response = $useCase->execute($request);

        // Assert
        $user = $response->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(2, $user->getId());
        $this->assertSame('Bob', $user->getName());
    }
}
