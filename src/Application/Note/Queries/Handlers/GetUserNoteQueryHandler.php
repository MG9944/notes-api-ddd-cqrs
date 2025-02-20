<?php

namespace App\Application\Note\Queries\Handlers;

use App\Application\Exceptions\NoteException;
use App\Application\Note\Queries\GetUserNoteQuery;
use App\Domain\Note\Note;
use App\Domain\Note\NoteRepositoryInterface;

class GetUserNoteQueryHandler
{

    public function __construct(private readonly NoteRepositoryInterface $noteRepository)
    {
    }

    public function handle(GetUserNoteQuery $query): Note
    {
        $note = $this->noteRepository->findUserNote($query->userId, $query->idNote);

        if(!$note) {
            throw NoteException::notFound();
        }

        return $note;
    }
}