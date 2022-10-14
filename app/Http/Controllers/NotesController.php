<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Note;

class NotesController extends Controller
{

    public function create(Request $request)
    {
        $execResult = [
            "error" => false,
            "message" => ""
        ];

        #  Validação da requisição
        $validationRules = [
            "note" => "required|min:5|max:255"
        ];

        $validator = Validator::make($request->only('note'), $validationRules);

        if($validator->fails())
        {
            $execResult['error']   = true;
            $execResult['message'] = $validator->getMessageBag();

            return $execResult;
        }

        # Salvando a nova anotação
        $newNote        = new Note();
        $newNote->note  = $request->note;
        $newNote->save();

        return json_encode($execResult);
    }

    public function getAll()
    {
        $execResult = [
            "error"   => false,
            "message" => "",
            "notes"   => []
        ];

        $execResult["notes"] = Note::all();

        return json_encode($execResult);
    }

    public function select()
    {
        return "selectNote";
    }
}
