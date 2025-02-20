<?php

namespace App\Application\User\Commands\Handlers;

use App\Application\User\Commands\CreateUserCommand;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\UserRepository;

readonly class CreateUserCommandHandler
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserFactory             $userFactory,
    ) {
    }

    public function handle(CreateUserCommand $command): void {
        $user = $this->userFactory->create($command);
        $this->userRepository->add($user);
    }
}