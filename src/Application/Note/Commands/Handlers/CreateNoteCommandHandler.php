<?php

namespace App\Application\Note\Commands\Handlers;

use App\Application\Note\Commands\CreateNoteCommand;
use App\Domain\Note\Factory\NoteFactory;
use App\Domain\Note\NoteRepositoryInterface;

readonly class CreateNoteCommandHandler
{

    public function __construct(
        private NoteRepositoryInterface $noteRepository,
        private NoteFactory             $noteFactory,
    ){
    }

    public function handle(CreateNoteCommand $command): void
    {
        $note = $this->noteFactory->create($command);
        $this->noteRepository->add($note);
    }
}