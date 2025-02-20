<?php

namespace App\Application\User\Commands;

class CreateUserCommand
{
    public string $username;
    public string $password;
    public string $email;
    public function __construct(string $username, string $password, string $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
}