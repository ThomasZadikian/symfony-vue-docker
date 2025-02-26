<?php

declare(strict_types=1);

namespace App\Application\Responses;

use App\Domain\Entity\User;

class CreateUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
