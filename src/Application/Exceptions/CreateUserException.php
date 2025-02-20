<?php

namespace App\Application\Exceptions;

class CreateUserException extends \Exception
{
    public static function userNotCreated(): \Exception
    {
        throw new self('There was a problem when creating a user account');
    }
}