<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetViewerController extends Controller
{
    public function __invoke(Request $request)
    {
        return $this->sendResponse([
            'user' => Auth::user()
        ]);
    }
}
