<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class User
{

    private ?int $id;

    private ?string $name;

    public function __construct(?int $id = null, string $name = '')
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
