<?php

namespace App\Application\Note\Queries\Handlers;

use App\Application\Exceptions\NoteException;
use App\Application\Note\Queries\GetUserNotesQuery;
use App\Domain\Note\NoteRepositoryInterface;

class GetUserNotesQueryHandler
{

    public function __construct(private readonly NoteRepositoryInterface $noteRepository)
    {
    }

    public function handle(GetUserNotesQuery $query): array
    {
        $notes = $this->noteRepository->findUserNotes($query->userId);

        if (!$notes) {
            throw NoteException::notFound();
        }

        return $notes;
    }
}