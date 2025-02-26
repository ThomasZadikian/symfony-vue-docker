<?php

declare(strict_types=1);

namespace App\Tests\UseCases;

use App\Application\UseCases\GetAllUsersUseCase;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class GetAllUsersUseCaseTest extends TestCase
{
    public function testExecuteReturnsEmptyArrayWhenNoUsersExist(): void
    {
        $repositoryMock = $this->createMock(UserRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('getUsers')
            ->willReturn([]);

        $useCase = new GetAllUsersUseCase($repositoryMock);
        $result = $useCase->execute();

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    public function testExecuteReturnsUsers(): void
    {
        $user1 = new User(1, 'John Doe');
        $user2 = new User(2, 'Jane Doe');

        $repositoryMock = $this->createMock(UserRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('getUsers')
            ->willReturn([$user1, $user2]);

        $useCase = new GetAllUsersUseCase($repositoryMock);
        $result = $useCase->execute();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertSame($user1, $result[0]);
        $this->assertSame($user2, $result[1]);
    }
}
