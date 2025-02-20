<?php

namespace App\Application\Note\Commands\Handlers;

use App\Application\Note\Commands\DeleteUserNoteCommand;
use App\Application\Note\Queries\GetUserNoteQuery;
use App\Application\Note\Queries\Handlers\GetUserNoteQueryHandler;
use App\Domain\Note\NoteRepositoryInterface;

readonly class DeleteUserNoteCommandHandler
{

    public function __construct(
      private NoteRepositoryInterface $noteRepository,
      private GetUserNoteQueryHandler $getUserNoteQueryHandler
    ) {
    }

    public function handle(DeleteUserNoteCommand $command): void
    {
        $note = $this->getUserNoteQueryHandler->handle(new GetUserNoteQuery($command->userId, $command->noteId));
        $this->noteRepository->delete($note);
    }
}