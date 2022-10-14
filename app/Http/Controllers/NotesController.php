<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class NotesController extends Controller
{

    public function create(Request $request)
    {
        $execResult = [
            "error" => false,
            "message" => ""
        ];

        /*
        | ---------------------------------------------------------------------
        |    Validação da requisição
        | ---------------------------------------------------------------------
       */
        $validationRules = [
            "note" => "required|min:5|max:255"
        ];

        $validator = Validator::make($request->only('note'), $validationRules);

        if($validator->fails())
        {
            $execResult['error']   = true;
            $execResult['message'] = $validator->getMessageBag();
        }

        return json_encode($execResult);
    }
}
