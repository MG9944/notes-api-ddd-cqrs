<?php

namespace App\Application\User\Commands;

class DeleteUserCommand
{
public int $userId;
    public function __construct(int $userId) {
        $this->userId = $userId;
    }
}