<?php

namespace App\Domain\Note\Factory;

use App\Application\Note\Commands\CreateNoteCommand;
use App\Domain\Note\Note;

class NoteFactory
{
    public function create(CreateNoteCommand $command): Note {
        $createdNote = new Note();
        $createdNote->setTitle($command->title);
        $createdNote->setContent($command->content);
        $createdNote->setVersion($command->version);
        $createdNote->setCreatedAt($command->createdAt);
        $createdNote->setUpdatedAt($command->updatedAt);
        $createdNote->setUserId($command->userId);

        return $createdNote;
    }
}