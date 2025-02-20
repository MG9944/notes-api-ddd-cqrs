<?php

namespace App\Application\Notification\Commands;

class UpdateNotificationCommand
{
    public int $notificationId;
    public string $status;
    public function __construct(int $notificationId, string $status)
    {
        $this->notificationId = $notificationId;
        $this->status = $status;
    }

}