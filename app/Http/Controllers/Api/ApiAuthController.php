<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed'
        ]);
        $admin = Admin::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $admin->createToken('myapptoken')->plainTextToken;
        return response([
            'message' => 'successfully create account',
            'admin' => $admin,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $admin = Admin::Where('email', $fields['email'])->first();

        // Check Password
        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response([
                'message' => 'ایمیل یا پسورد اشتباه است .',
            ]);
        }

        $token = $admin->createToken('myapptoken')->plainTextToken;

        $response = [
            'message' => 'you are logged',
            'user' => $admin,
            'token' => $token
        ];
        return response($response);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'logged out',
        ]);
    }
}
