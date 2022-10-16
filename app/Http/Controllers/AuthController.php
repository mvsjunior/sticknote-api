<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Supporte\Facades\Auth;
use Illuminate\Supporte\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function create(Request $request)
    {
        $array = ['error' => ''];

        // validação
        $rules = [
            'email'    => 'required|email|unique:users,email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $array['error'] = $validator->message();
            return $array;
        }

        $email    = $request->input('email');
        $password = $request->input('password');

        // Criando novo usuário
        $newUser           = new User();
        $newUser->email    = $email;
        $newUser->password = password_hash($password, PASSWORD_DEFAULT);
        $newUser->token    = "";
        $newUser->save();

        // Logar o usuário recém criado.
        return $array;
    }


}
