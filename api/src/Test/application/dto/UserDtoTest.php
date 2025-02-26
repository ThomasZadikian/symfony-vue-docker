<?php

declare(strict_types=1);

namespace App\Tests\Dto;

use App\Application\Dto\UserDto;
use App\Domain\Entity\User;
use PHPUnit\Framework\TestCase;

class UserDtoTest extends TestCase
{
    public function testUserDtoCreation(): void
    {
        $id = 1;
        $name = 'John Doe';

        $user = new User($id, $name);
        $userDto = new UserDto($id, $name);

        $this->assertSame($id, $userDto->fromEntity($user)->id);
        $this->assertSame($name, $userDto->fromEntity($user)->name);
    }
}
