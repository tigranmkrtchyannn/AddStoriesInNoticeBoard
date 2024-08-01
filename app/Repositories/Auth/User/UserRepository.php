<?php

namespace App\Repositories\Auth\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    protected function query(): Builder
    {
        return User::query();
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->query()->where('email', $email)->first();
    }

    public function store(array $data): User
    {
        return $this->query()->create($data);
    }
}
