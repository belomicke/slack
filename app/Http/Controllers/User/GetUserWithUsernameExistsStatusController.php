<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserWithUsernameExistsStatusRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Request;

class GetUserWithUsernameExistsStatusController extends Controller
{
    public function __construct(
        private readonly UserRepository $users
    ) {}

    public function __invoke(GetUserWithUsernameExistsStatusRequest $request)
    {
        $username = $request->get('username');
        $exists = $this->users->getUserWithUsernameExistsStatus(username: $username);

        return $this->sendResponse(data: [
            'exists' => $exists
        ]);
    }
}
