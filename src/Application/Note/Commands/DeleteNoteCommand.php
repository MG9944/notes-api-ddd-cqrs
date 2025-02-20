<?php

namespace App\Application\Note\Commands;

class DeleteNoteCommand
{
    public int $noteId;

    public function __construct(int $noteId)
    {
        $this->noteId = $noteId;
    }


}