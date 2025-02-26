<?php

declare(strict_types=1);

namespace App\Application\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct(string $message = 'User not found')
    {
        parent::__construct($message);
    }
}
