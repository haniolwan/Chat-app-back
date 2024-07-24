<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;


class UserAuthController extends Controller
{
    use ResponseTrait;
    public function register(Request $request)
    {
        $registerUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password'])
        ]);

        return $this->success_response(
            ["User Registered successfully"],
            ["User" => [
                "name" => $user->name, "email" => $user->email
            ]],
            200
        );
    }

    public function login(Request $request)
    {
        $user = User::where('email',  $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->fail_response(["Password doesnt match"], 400);
        }

        $user->tokens()->delete();

        return $this->success_response([
            'User logged in successfully',
        ], ["User" => [
            'name' => $user->name,
            'avatar' => $user->avatar,
            'email' => $user->email,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success_response(
            ['User logged out successfully'],
            [],
            200
        );
    }
}
