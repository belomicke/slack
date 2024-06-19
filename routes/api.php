<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require_once 'api/auth.php';
require_once 'api/users.php';
require_once 'api/workspaces.php';

Route::post('save-profile-avatar', function (Request $request) {
    $number = $request->get('number');
    $avatar = $request->file('avatar');

    return response()->json([
        'number' => $number,
        'avatar' => $avatar
    ]);
});
