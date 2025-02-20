<?php

namespace App\Application\Notification\Commands;

use DateTimeImmutable;

class CreateNotificationCommand
{
    public string $type;
    public string $message;
    public string $status;
    public int $userId;
    public DateTimeImmutable $createdAt;

    public function __construct(string $type, string $message, string $status, int $userId)
    {
        $this->type = $type;
        $this->message = $message;
        $this->status = $status;
        $this->userId = $userId;
        $this->createdAt = new DateTimeImmutable();
    }
}