<?php

namespace App\Application\Notification;

use App\Application\Notification\Commands\UpdateNotificationCommand;
use App\Application\Notification\Queries\GetNotificationQuery;
use App\Application\Notification\Queries\Handlers\GetNotificationQueryHandler;
use App\Domain\Notification\Notification;

class NotificationService
{

    public function __construct(
      private readonly GetNotificationQueryHandler $getNotificationQueryHandler,
    ) {
    }

    public function edit(UpdateNotificationCommand $command): Notification {
        $notification = $this->getNotificationQueryHandler->handle(new GetNotificationQuery($command->notificationId));
        $notification->setStatus($command->status);

        return $notification;
    }
}