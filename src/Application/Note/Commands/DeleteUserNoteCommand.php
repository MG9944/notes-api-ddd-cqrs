<?php

namespace App\Application\Note\Commands;

class DeleteUserNoteCommand
{
    public int $noteId;
    public int $userId;
    public function __construct(int $noteId, int $userId) {
        $this->noteId = $noteId;
        $this->userId = $userId;
    }
}