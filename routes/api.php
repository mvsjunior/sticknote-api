<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

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

#Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
#    return $request->user();
#});

Route::post('/note/create', [NotesController::class, 'create'])->name('note.create');
Route::get('/notes', [NotesController::class, 'getAll'])->name('note.getAll');
Route::get('/note/{id}', [NotesController::class, 'select'])->name('note.select');
