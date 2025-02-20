<?php

namespace App\Application\User\Queries;

class GetUserQuery
{
    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}