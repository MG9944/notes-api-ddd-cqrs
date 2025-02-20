<?php

namespace App\Application\Note;

use App\Application\Note\Commands\UpdateNoteCommand;
use App\Application\Note\Queries\GetNoteQuery;
use App\Application\Note\Queries\GetUserNoteQuery;

use App\Application\Note\Queries\Handlers\GetNoteQueryHandler;
use App\Domain\Note\Note;

class NoteService
{
    public function __construct(private readonly GetNoteQueryHandler $getNoteQueryHandler)
    {
    }

    public function edit(UpdateNoteCommand $command): Note  {
        $note = $this->getNoteQueryHandler->handle(new GetNoteQuery($command->noteId));
        $note->setTitle($command->title);
        $note->setContent($command->content);
        $note->setVersion($command->version);

        return $note;
    }
}