<?php

namespace App\Repositories\Auth\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function store(array $data): User;
    public function getUserByEmail(string $email): ?User;

}
