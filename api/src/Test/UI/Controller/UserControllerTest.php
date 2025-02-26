<?php

declare(strict_types=1);

namespace App\Tests\UI\Controller;

use App\Application\Requests\CreateUserRequest;
use App\Application\Responses\CreateUserResponse;
use App\Application\UseCases\CreateUserUseCase;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\UI\Controller\UserController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserControllerTest extends TestCase
{
    public function testGetUsersReturnsJsonResponse(): void
    {
        $user1 = new User(1, 'John Doe');
        $user2 = new User(2, 'Jane Doe');

        $repositoryStub = $this->createMock(UserRepositoryInterface::class);
        $repositoryStub->expects($this->once())
            ->method('getUsers')
            ->willReturn([$user1, $user2]);

        $useCaseStub = $this->createMock(CreateUserUseCase::class);

        $controller = new UserController($useCaseStub, $repositoryStub);
        $controller->setContainer(new Container());

        $response = $controller->getUsers();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertCount(2, $data);

        $this->assertSame(1, $data[0]['id']);
        $this->assertSame('John Doe', $data[0]['name']);
        $this->assertSame(2, $data[1]['id']);
        $this->assertSame('Jane Doe', $data[1]['name']);
    }

    public function testCreateUserReturnsJsonResponseOnSuccess(): void
    {
        $newUser = new User(3, 'Alice');

        $createUserResponse = new CreateUserResponse($newUser);

        $useCaseStub = $this->createMock(CreateUserUseCase::class);
        $useCaseStub->expects($this->once())
            ->method('execute')
            ->with($this->callback(function ($request) {
                return $request instanceof CreateUserRequest && $request->getName() === 'Alice';
            }))
            ->willReturn($createUserResponse);

        $repositoryStub = $this->createMock(UserRepositoryInterface::class);

        $controller = new UserController($useCaseStub, $repositoryStub);
        $controller->setContainer(new Container());

        $jsonContent = json_encode(['name' => 'Alice']);
        $request = new Request([], [], [], [], [], [], $jsonContent);

        $response = $controller->createUser($request);
        $this->assertInstanceOf(JsonResponse::class, $response);

        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
    }

    public function testCreateUserReturnsErrorOnMissingName(): void
    {
        $useCaseStub = $this->createMock(CreateUserUseCase::class);
        $repositoryStub = $this->createMock(UserRepositoryInterface::class);

        $controller = new UserController($useCaseStub, $repositoryStub);
        $controller->setContainer(new Container());

        $jsonContent = json_encode([]);
        $request = new Request([], [], [], [], [], [], $jsonContent);

        $response = $controller->createUser($request);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('error', $data);
        $this->assertSame('Missing name field', $data['error']);
    }
}
