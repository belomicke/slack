<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateAccountRequest;
use App\Repositories\UserRepository;

class CreateAccountController extends Controller
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly UserHelpers $userHelpers
    ) {}

    public function __invoke(CreateAccountRequest $request)
    {
        $email = $request->get('email');

        if (!$this->userHelpers->checkEmailIsValid(email: $email)) {
            return $this->sendError();
        }

        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $username = $request->get('username');
        $password = $request->get('password');

        $user = $this->users->createUser(
            firstName: $firstName,
            lastName: $lastName,
            username: $username,
            email: $email,
            password: $password
        );

        $token = $user->createToken('user')->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
        ]);
    }
}
