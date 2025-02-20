<?php

namespace App\Application\User\Commands;

class UpdateUserCommand
{
    public int $userId;
    public string $username;
    public string $status;
    public string $email;
    public function __construct(int $userId, string $username, string $status, string $email) {
        $this->userId = $userId;
        $this->username = $username;
        $this->status = $status;
        $this->email = $email;
    }
}