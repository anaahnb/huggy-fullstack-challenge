<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $credenciais = $request->all('email', 'password');
        $token = auth('api')->attempt($credenciais);

        if($token) {
            return response()->json(['token' => $token], 200);
        } else{
            return response()->json(['errors' => ['email' => ['Usuário ou senha inválido']]], 403);
        }

        return 'login';
    }


    public function register(UserRegistroRequest $request)
    {
        User::criarUsuario($request);
        return response()->json(['message' => 'Usuário registrado com sucesso'], 201);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado com sucesso']);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }


}
