<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }
        if (!auth()->attempt($data)) {
            return response()->json('ایمیل یا رمز عبور اشتباه است.', 422);
        }
        $user = auth()->user();
        $tokenResult = $user->createToken('userToken');
        $tokenModel = $tokenResult->token;
        if ($request->remember_me)
            $tokenModel->expires_at = Carbon::now()->addWeeks(1);
        $tokenModel->save();
        return response()->json([
            'user' => new UserResource($user),
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ]);
    }
}
