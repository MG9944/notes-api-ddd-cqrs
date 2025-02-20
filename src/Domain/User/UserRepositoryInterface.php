<?php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;
    public function delete(User $user): void;
    public function update(User $user): void;
}