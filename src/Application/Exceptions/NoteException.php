<?php

namespace App\Application\Exceptions;

class NoteException extends \Exception
{
    public static function notFound(): \Exception
    {
        throw new self('Note not found');
    }
}