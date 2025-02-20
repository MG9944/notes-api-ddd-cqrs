<?php

namespace App\Application\Note\Commands;

use DateTimeImmutable;

class CreateNoteCommand
{
    public string $title;
    public string $content;
    public DateTimeImmutable $createdAt;

    public DateTimeImmutable $updatedAt;
    public string $version;
    public int $userId;

    public function __construct(string $title, string $content,  string $version, int $userId)
    {
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->version = $version;
        $this->userId = $userId;
    }
}