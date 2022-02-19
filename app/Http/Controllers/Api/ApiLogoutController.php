<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiLogoutController extends Controller
{
    public function logout(Request $request)
    {
        /** @var User $user
         */
        $request->user()->token()->revoke();
        return response()->json('شما با موفقیت خارج شدید.');
    }
}
