<?php

namespace App\Application\Notification\Commands\Handlers;

use App\Application\Notification\Commands\UpdateNotificationCommand;
use App\Application\Notification\NotificationService;
use App\Domain\Notification\NotificationRepositoryInterface;

readonly class UpdateNotificationCommandHandler
{

    public function __construct(
     private NotificationRepositoryInterface $notificationRepository,
     private NotificationService             $notificationService
    ) {
    }

    public function handle(UpdateNotificationCommand $command): void
    {
        $notification = $this->notificationService->edit($command);
        $this->notificationRepository->update($notification);
    }
}