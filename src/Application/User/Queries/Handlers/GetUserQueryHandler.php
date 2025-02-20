<?php

namespace App\Application\User\Queries\Handlers;

use App\Application\Exceptions\UserException;
use App\Application\User\Queries\GetUserQuery;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class GetUserQueryHandler
{

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle(GetUserQuery $query): User
    {
        $user = $this->repository->find($query->userId);

        if (!$user) {
            throw UserException::notFound();
        }

        return $user;
    }
}