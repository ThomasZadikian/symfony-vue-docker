<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use RuntimeException;
use Symfony\Component\HttpKernel\KernelInterface;

class UserRepository implements UserRepositoryInterface
{
    private string $filePath;

    public function __construct(KernelInterface $kernel)
    {
        $this->filePath = $kernel->getProjectDir() . '/src/Database/database.json';
    }

    /**
     * Read and decode the JSON file.
     *
     * @return array
     * @throws RuntimeException Si le fichier est introuvable ou le JSON mal formé.
     */
    private function getData(): array
    {
        if (!file_exists($this->filePath)) {
            throw new RuntimeException("⚠ Le fichier database.json n'existe pas !");
        }

        $json = file_get_contents($this->filePath);
        $decodedData = json_decode($json, true);

        if ($decodedData === null) {
            throw new RuntimeException('⛔ JSON mal formé : ' . json_last_error_msg());
        }

        return $decodedData;
    }

    /**
     * Return an User list from the JSON file.
     *
     * @return User[]
     */
    public function getUsers(): array
    {
        $data = $this->getData();
        $usersData = $data['users'] ?? [];
        $users = [];

        foreach ($usersData as $userData) {
            if (isset($userData['id'], $userData['name'])) {
                $users[] = new User($userData['id'], $userData['name']);
            }
        }

        return $users;
    }

    /**
     * Save an User in the JSON file by saving the previous Json
     *
     * @param  User             $user
     * @throws RuntimeException Si l'encodage JSON échoue.
     */
    public function saveUser(User $user): void
    {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $data = json_decode($jsonContent, true);
            if (!is_array($data) || !isset($data['users'])) {
                $data = ['users' => []];
            }
        } else {
            $data = ['users' => []];
        }

        $data['users'][] = [
            'id' => $user->getId(),
            'name' => $user->getName(),
        ];

        $json = json_encode($data, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new RuntimeException("Erreur lors de l'encodage JSON : " . json_last_error_msg());
        }

        file_put_contents($this->filePath, $json);
    }
}
