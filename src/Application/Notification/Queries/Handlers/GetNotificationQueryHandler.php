<?php

namespace App\Application\Notification\Queries\Handlers;

use App\Application\Exceptions\NotificationException;
use App\Application\Notification\Queries\GetNotificationQuery;
use App\Domain\Notification\Notification;
use App\Domain\Notification\NotificationRepositoryInterface;

class GetNotificationQueryHandler
{

    public function __construct( private readonly NotificationRepositoryInterface $notificationRepository)
    {
    }

    public function handle(GetNotificationQuery $query): Notification
    {
        $notification = $this->notificationRepository->find($query->notificationId);

        if(! $notification) {
            throw NotificationException::notFound();
        }

        return $notification;
    }
}