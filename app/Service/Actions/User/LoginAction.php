<?php

namespace App\Service\Actions\User;

use App\Repositories\Auth\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public $userRepository;
    public function __construct(public UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function run($data)
    {
        $email = $data['email'];
        $user = $this->userRepository->getUserByEmail($email);

        if ($user) {
            if (Auth::attempt(['email' => $email, 'password' => $data['password']])) {
                $user_token['token'] = $user->createToken('appToken')->accessToken;

                return true;
            } else {
                return false;
            }
        }
    }

}
