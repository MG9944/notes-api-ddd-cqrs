<?php

namespace App\Domain\Notification;

interface NotificationRepositoryInterface
{
    public function add(Notification $notification): void;
    public function update(Notification $notification): void;
}