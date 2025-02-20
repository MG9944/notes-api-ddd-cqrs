<?php

namespace App\Application\Exceptions;

class UserException extends \Exception
{
    public static function notFound(): \Exception
    {
        throw new self('User not found');
    }
}