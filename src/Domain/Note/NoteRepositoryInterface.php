<?php

namespace App\Domain\Note;

use App\Domain\Note\Note;

interface NoteRepositoryInterface
{
    public function add(Note $note): void;
    public function delete(Note $note): void;
    public function update(Note $note): void;

    public function findUserNote(int $userId, int $noteId): ?Note;
    public function findUserNotes(int $userId): array;
}