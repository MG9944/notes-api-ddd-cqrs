<?php

namespace App\Application\User;

use App\Application\Note\Queries\GetUserNotesQuery;
use App\Application\Note\Queries\Handlers\GetUserNotesQueryHandler;
use App\Application\User\Commands\UpdateUserCommand;
use App\Application\User\Queries\GetUserQuery;
use App\Application\User\Queries\Handlers\GetUserQueryHandler;
use App\Domain\User\User;
use DateTimeImmutable;

class UserService
{
    public function __construct(
        private readonly GetUserQueryHandler $getUserQueryHandler,
        private readonly GetUserNotesQueryHandler $getUserNotesQueryHandler,
    ) {
    }

    public function edit(UpdateUserCommand $command): User {
        $foundUser = $this->getUserQueryHandler->handle(new GetUserQuery($command->userId));
        $foundUser->setUsername($command->username);
        $foundUser->setEmail($command->email);
        $foundUser->setStatus($command->status);
        $foundUser->setUpdatedAt(new DateTimeImmutable());

        return $foundUser;
    }

    public function getUserInfo(int $userId): array {
        $user = $this->getUserQueryHandler->handle(new GetUserQuery($userId));
        $notes = $this->getUserNotesQueryHandler->handle(new GetUserNotesQuery($userId));

        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'status' => $user->getStatus(),
            'updatedAt' => $user->getUpdatedAt(),
            'notes' => $notes
        ];
    }
}