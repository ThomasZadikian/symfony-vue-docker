<?php

declare(strict_types=1);

namespace App\Application\Dto;

use App\Domain\Entity\User;

class UserDto
{
    public int $id;

    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromEntity(User $user): self
    {
        return new self($user->getId(), $user->getName());
    }
}
