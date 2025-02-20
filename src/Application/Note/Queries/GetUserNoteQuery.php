<?php

namespace App\Application\Note\Queries;

class GetUserNoteQuery
{
    public int $idNote;
    public int $userId;

    public function __construct(int $idNote, int $userId)
    {
        $this->idNote = $idNote;
        $this->userId = $userId;
    }
}