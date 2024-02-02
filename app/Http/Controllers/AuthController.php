<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function cadastrar(Request $request){
        //valida informações de cadastro
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        //Cria o novo usuário
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        //Gera um token para o novo usuário
        $token = $user->createToken('token_autenticacao')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //Retorna o usuário criado e seu respectivo token
        return response($response, 201);
    }

    public function login(Request $request){
        //valida informações de login
        $fields = $request->validate([
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        //Verifica email
        $user = User::where('email', $fields['email']);

        //Verifica login
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response('Email ou senha incorretos', 401);
        }

        //Gera um token para o novo usuário
        $token = $user->createToken('token_autenticacao')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //Retorna o usuário criado e seu respectivo token
        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response('Saiu com sucesso!', 201);;
    }
}
