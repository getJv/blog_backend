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
                'username' => 'required|email',
                'password' => 'required'
            ]);

            $http = new \GuzzleHttp\Client;

            $reponse = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => config('services.passport.client_id'),
                    'client_secret'    => config('services.passport.client_secret'),
                    'username' => $loginData['username'],
                    'password' => $loginData['password'],
                ]
            ]);


            return response($reponse->getBody());
        } catch (Exception $th) {
            return response(['message' => $th->getMessage()], 404);
        }
    }

    public function logout(){
        auth()->user()->tokens->each(function($token,$key){
            $token->delete();
        });

        return response(['Logout successifully']);
    }
}
