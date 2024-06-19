<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserWithEmailExitstStatusRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class GetUserWithEmailExistsStatusController extends Controller
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly UserHelpers $userHelpers
    ) {}

    public function __invoke(GetUserWithEmailExitstStatusRequest $request)
    {
        $email = $request->get('email');

        if (!$this->userHelpers->checkEmailIsValid(email: $email)) {
            return $this->sendResponse(data: [
                'exists' => false
            ]);
        }

        $exists = $this->users->getUserWithEmailExistsStatus(email: $email);

        return $this->sendResponse(data: [
            'exists' => $exists
        ]);
    }
}
