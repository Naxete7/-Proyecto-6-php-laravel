<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PartyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//USER
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::put('/update/{id}', [UserController::class, 'updateUser']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::delete('/deleteUser', [UserController::class, 'deleteUser']);

//AUTH

Route::group([
    'middleware'=>'jwt.auth'
], function(){
    Route::get('/me',[AuthController::class, 'profile']);
});



//GAME

Route::post('/game', [GameController::class, 'createAGame']);
Route::put('/updatedGame/{id}', [GameController::class, 'updatedGame']);
Route::delete('/game/{name}', [GameController::class, 'deleteGameByName']);
Route::get('/games', [GameController::class, 'getAllGames']);
Route::get('/game/name/{name}', [GameController::class, 'getGameByName']);


//PARTY

Route::post('/party', [PartyController::class, 'createPArty']);
Route::post('/exitParty', [PartyController::class, 'exitParty']);


//MESSAGES


Route::post('/message', [MessagesController::class, 'postMessage']);
Route::put('/message/{id}', [MessagesController::class, 'updateMessage']);
Route::delete('/message/{id}', [MessagesController::class, 'deleteMessage']);
Route::get('/allMessages', [MessagesController::class, 'getAllMessages']);