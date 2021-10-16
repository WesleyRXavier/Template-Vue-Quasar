<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;



class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //dd($request->all());
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('web-token')->plainTextToken;

        return response(
            [

                'status' => 201,
                'message' => 'Usuario criado com sucesso',
                'user' => $user,
                'token' => $token
            ],201
            
        );
    }



    public function login(LoginRequest $request)
    {
        // Check email
        $user = User::where('email', $request->email)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(
                [
                    'status' => 401,
                    'message' => 'Email ou senha invalido'
                ],
                401
            );
        }

        $token = $user->createToken('web-token')->plainTextToken;

        
        return response(
            [

                'status' => 200,
                'message' => 'Usuario logado com sucesso',
                'user' => $user,
                'token' => $token
            ],200
            
        );
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        
        return response(
            [
                'status' => 200,
                'message' => 'sessão encerrada com sucesso',
                
            ],200
            
        );
    }
}
