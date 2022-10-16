<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Note;
use App\Models\User;

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
        $newNote          = new Note();
        $newNote->note    = $request->note;
        $newNote->user_id = $request->user()->id;
        $newNote->save();

        return json_encode($execResult);
    }

    public function getAll(Request $request)
    {
        $execResult = [
            "error"   => false,
            "message" => "",
            "notes"   => []
        ];

        $userId = $request->user()->id;

        $notesForThisUserId  = [
            "user_id" => $userId
        ];

        $execResult["notes"] = Note::where( $notesForThisUserId )->get();

        return json_encode($execResult);
    }

    public function select(Request $request)
    {
        $execResult = [
            "error"   => false,
            "message" => "",
            "note"   => []
        ];

        $noteId = $request->id;
        $userId = $request->user()->id;

        $queryParams  = [
            "user_id" => $userId,
            "id"      => $noteId
        ];

        $note = Note::where($queryParams)->first();

        if(empty($note))
        {
            $execResult["error"]   = true;
            $execResult["message"] = "Nota não encontrada";
        }
        else
        {
            $execResult["note"] = $note;
        }

        return $execResult;
    }

    public function update(Request $request)
    {
        $execResult = [
            "error"   => false,
            "message" => ""
        ];

        #  Validação da requisição
        $validationRules = [
            "note"  => "min:5|max:255",
            "id"    => "required|integer",
            "done"  => "boolean"
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if($validator->fails())
        {
            $execResult['error']   = true;
            $execResult['message'] = $validator->getMessageBag();

            return json_encode($execResult);
        }

        $params = $request->all();

        # verificando se o campo done ou note foram informados
        if( !isset($params['done']) && !isset($params['note']) )
        {
            $execResult['error']   = true;
            $execResult['message'] = "Não foi possível atualizar os dados. Informe os parâmetros note ou done";

            return json_encode($execResult);
        }

        # Faz a busca de um registro válido
        $noteId = $request->id;
        $userId = $request->user()->id;

        $queryParams  = [
            "user_id" => $userId,
            "id"      => $noteId
        ];

        $noteUpdated = Note::where($queryParams)->first();

        if(empty($noteUpdated))
        {
            $execResult['error']   = true;
            $execResult['message'] = "Não foi encontrado nenhum registro de nota com o id informado";

            return $execResult;
        }

        # atualiza os dados solicitados
        if(empty($request->note) == FALSE)
        {
            $noteUpdated->note  = $request->note;
        }

        if(empty($request->done) == FALSE)
        {
            $noteUpdated->done  = $request->done;
        }

        $noteUpdated->update();

        return json_encode($execResult);
    }

    public function delete(Request $request)
    {
        $execResult = [
            "error"   => false,
            "message" => ""
        ];

        #  Validação da requisição
        $validationRules = [
            "id"    => "required|integer|max:999|min:1"
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if($validator->fails())
        {
            $execResult['error']   = true;
            $execResult['message'] = $validator->getMessageBag();

            return json_encode($execResult);
        }

        # Faz a busca de um registro válido
        $noteId = $request->id;
        $userId = $request->user()->id;

        $queryParams  = [
            "user_id" => $userId,
            "id"      => $noteId
        ];

        $deleteResult = Note::destroy($queryParams);

        if($deleteResult == FALSE)
        {
            $execResult["error"]   = true;
            $execResult["message"] = "Não foi possível realizar a exclusão, não foi encontrada uma nota com a id informada";
        }

        return json_encode($execResult);
    }
}