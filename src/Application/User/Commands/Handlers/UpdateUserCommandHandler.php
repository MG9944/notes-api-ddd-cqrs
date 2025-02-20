<?php

namespace App\Application\User\Commands\Handlers;

use App\Application\User\Commands\UpdateUserCommand;
use App\Application\User\UserService;
use App\Domain\User\UserRepositoryInterface;

readonly class UpdateUserCommandHandler
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserService    $userService
    ) {
    }

    public function handle(UpdateUserCommand $command): void{
        $editedUser = $this->userService->edit($command);
        $this->userRepository->update($editedUser);
    }

}