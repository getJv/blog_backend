<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }
    public function login(Request $request)
    {

        try {

            $loginData = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (!auth()->attempt($loginData)) {
                return response(['message' =>     'errooo'], 404);
               // throw new Exception('Invalid credentials');
            }


            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        } catch (Exception $th) {
            return response(['message' => $th->getMessage()], 404);
        }
    }
}
