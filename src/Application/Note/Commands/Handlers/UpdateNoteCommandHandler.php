<?php

namespace App\Application\Note\Commands\Handlers;

use App\Application\Note\Commands\UpdateNoteCommand;
use App\Application\Note\NoteService;
use App\Domain\Note\NoteRepositoryInterface;

class UpdateNoteCommandHandler
{

    public function __construct(
        private readonly NoteRepositoryInterface $noteRepository,
        private readonly NoteService $noteService
    ) {
    }

    public function handle(UpdateNoteCommand $command): void
    {
        $note = $this->noteService->edit($command);
        $this->noteRepository->update($note);
    }
}