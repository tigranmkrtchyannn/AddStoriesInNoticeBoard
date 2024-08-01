<?php

namespace App\Service\Actions\User;

use App\Repositories\Auth\User\UserRepositoryInterface;

class RegistrationAction
{
    public $userRepository;
    public function __construct(public UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function run(array $data)
    {
        return $this->userRepository->store($data);
    }
}
