<?php

namespace App\Application\Exceptions;

class NotificationException extends \Exception
{
    public static function notFound(): \Exception
    {
        throw new self('Notification not found');
    }
}