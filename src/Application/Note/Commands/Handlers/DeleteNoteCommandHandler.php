<?php

namespace App\Application\Note\Commands\Handlers;

use App\Application\Note\Commands\DeleteNoteCommand;
use App\Application\Note\Queries\GetNoteQuery;
use App\Application\Note\Queries\Handlers\GetNoteQueryHandler;
use App\Domain\Note\NoteRepositoryInterface;

readonly class DeleteNoteCommandHandler
{
    public function __construct(
        private NoteRepositoryInterface $noteRepository,
        private GetNoteQueryHandler     $noteQueryHandler
    ) {
    }

    public function handle(DeleteNoteCommand $command): void
    {
        $note = $this->noteQueryHandler->handle(new GetNoteQuery($command->noteId));
        $this->noteRepository->delete($note);
    }
}