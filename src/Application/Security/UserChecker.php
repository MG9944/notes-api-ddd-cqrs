<?php

namespace App\Application\Security;

use App\Application\Exceptions\AccountDisabledException;
use App\Domain\User\User;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    private const STATUS_ACTIVE = 'active';

    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        if ($user->getStatus() !== self::STATUS_ACTIVE) {
            throw AccountDisabledException::problemAccount();
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
    }
}