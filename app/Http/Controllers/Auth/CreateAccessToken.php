<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateAccessTokenRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class CreateAccessToken extends Controller
{
    public function __construct(
        private readonly UserRepository $users
    ) {}

    public function __invoke(CreateAccessTokenRequest $request)
    {
        $login = $request->get('login');
        $password = $request->get('password');

        $user = $this->users->getUserByLogin(login: $login);

        if (!$user || !Hash::check($password, $user->password)) {
            return $this->sendError();
        }

        return $this->sendResponse([
            'token' => $user->createToken('user')->plainTextToken
        ]);
    }
}
