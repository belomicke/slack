<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteAccessTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $viewer = Auth::user();
        $viewer->tokens()->delete();
        return $this->sendResponse();
    }
}
