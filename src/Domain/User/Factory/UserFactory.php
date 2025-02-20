<?php

namespace App\Domain\User\Factory;

use App\Application\Exceptions\CreateUserException;
use App\Application\User\Commands\CreateUserCommand;
use App\Domain\User\User;

class UserFactory
{
 public function create(CreateUserCommand $user)
 {
     try {
         $createdUser = new User();
         $createdUser->setEmail($user->email);
         $createdUser->setUsername($user->username);
         $createdUser->setPassword($user->password);
         $createdUser->setCreatedAt(new \DateTimeImmutable());
         $createdUser->setStatus("active");

         return $createdUser;
     } catch (\Exception $exception) {
         throw CreateUserException::userNotCreated();
     }
 }
}