<?php

namespace App\Application\Notification\Commands\Handlers;

use App\Application\Notification\Commands\CreateNotificationCommand;
use App\Domain\Notification\Factory\NotificationFactory;
use App\Domain\Notification\NotificationRepositoryInterface;

readonly class CreateNotificationCommandHandler
{

    public function __construct(
        private NotificationRepositoryInterface $notificationRepository,
        private NotificationFactory             $notificationFactory
    ){
    }

    public function handle(CreateNotificationCommand $command): void
    {
        $notification = $this->notificationFactory->create($command);
        $this->notificationRepository->add($notification);
    }
}