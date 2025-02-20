<?php

namespace App\Application\Notification\Queries;

class GetNotificationQuery
{
    public int $notificationId;


    public function __construct(int $notificationId)
    {
        $this->notificationId = $notificationId;
    }

}