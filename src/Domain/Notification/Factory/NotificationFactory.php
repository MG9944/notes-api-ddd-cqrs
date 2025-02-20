<?php

namespace App\Domain\Notification\Factory;

use App\Application\Notification\Commands\CreateNotificationCommand;
use App\Domain\Notification\Notification;

class NotificationFactory
{
    public function create(CreateNotificationCommand $command): Notification {
        $notification = new Notification();
        $notification->setType($command->type);
        $notification->setMessage($command->message);
        $notification->setStatus($command->status);
        $notification->setUserId($command->userId);

        return $notification;
    }
}