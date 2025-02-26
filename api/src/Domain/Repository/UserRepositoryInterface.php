<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * Récupère tous les utilisateurs existants.
     *
     * @return User[]
     */
    public function getUsers(): array;

    /**
     * Sauvegarde un utilisateur.
     *
     * @param User $user
     */
    public function saveUser(User $users): void;
}
