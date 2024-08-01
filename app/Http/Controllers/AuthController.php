<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Service\Actions\User\LoginAction;
use App\Service\Actions\User\RegistrationAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request, RegistrationAction $registrationAction): JsonResponse
    {
        $data = $request->all();
        $registrationAction->run($data);
        return response()->json(["message" => "user stored successfully"]);
    }

    public function login(LoginRequest $request, LoginAction $loginAction): RedirectResponse
    {
        $data = $request->all();
        $success = $loginAction->run($data);

        if ($success) {
            return redirect()
                ->route('addStory');
        }

        return redirect()->back()
            ->withErrors(['error' => 'Invalid email or password'])
            ->withInput();
    }
}
