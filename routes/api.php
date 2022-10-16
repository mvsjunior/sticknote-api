<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
| ---------------------------------------------------------------------
|  Não autenticado
| ---------------------------------------------------------------------
| 
*/
Route::get('/unauthenticated', function (){
    return ['error' => 'Usuário não logado'];
})->name('login');
/*
| ---------------------------------------------------------------------
|  Autenticação
| ---------------------------------------------------------------------
| 
*/
Route::post('/user', [AuthController::class, 'create']);
Route::post('/auth', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->post('/note/create', [NotesController::class, 'create'])->name('note.create');
Route::middleware('auth:sanctum')->get('/notes', [NotesController::class, 'getAll'])->name('note.getAll');
Route::middleware('auth:sanctum')->get('/note/{id}', [NotesController::class, 'select'])->name('note.select');
Route::middleware('auth:sanctum')->put('/note/update', [NotesController::class, 'update'])->name('note.update');
Route::middleware('auth:sanctum')->delete('/note/delete', [NotesController::class, 'delete'])->name('note.delete');
