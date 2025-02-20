<?php

namespace App\Application\Note\Queries;

class GetUserNotesQuery
{
    public int $userId;
    public function __construct(int $userId) {
        $this->userId = $userId;
    }
}