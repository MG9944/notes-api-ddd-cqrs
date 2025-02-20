<?php

namespace App\Application\Note\Queries\Handlers;

use App\Application\Exceptions\NoteException;
use App\Application\Note\Queries\GetNoteQuery;
use App\Domain\Note\Note;
use App\Domain\Note\NoteRepositoryInterface;

readonly class GetNoteQueryHandler
{

    public function __construct(private NoteRepositoryInterface $noteRepository)
    {
    }

    public function handle(GetNoteQuery $query): Note
    {
        $foundNote = $this->noteRepository->find($query->idNote);

        if (!$foundNote) {
            throw NoteException::notFound();
        }

        return $foundNote;
    }
}