<?php

namespace App\Application\Note\Commands;

use DateTimeImmutable;

class UpdateNoteCommand
{
    public int $noteId;
    public string $title;
    public string $content;
    public string $version;
    public DateTimeImmutable $updatedAt;


    public function __construct(int $noteId, string $title, string $content, string $version)
    {
        $this->noteId = $noteId;
        $this->title = $title;
        $this->content = $content;
        $this->version = $version;
        $this->updatedAt = new DateTimeImmutable();
    }
}