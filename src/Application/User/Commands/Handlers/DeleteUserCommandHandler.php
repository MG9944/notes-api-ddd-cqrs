<?php

namespace App\Application\User\Commands\Handlers;

use App\Application\User\Commands\DeleteUserCommand;
use App\Application\User\Queries\GetUserQuery;
use App\Application\User\Queries\Handlers\GetUserQueryHandler;
use App\Domain\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class DeleteUserCommandHandler
{

    public function __construct(
        private UserRepositoryInterface $repository,
        private GetUserQueryHandler     $getUserQueryHandler
    ) {
    }

    public function handle(DeleteUserCommand $command): void {

        $this->repository->delete(
            $this->getUserQueryHandler->handle(
                new GetUserQuery($command->userId)
            )
        );
    }
}