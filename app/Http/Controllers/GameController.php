<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function createAGame(Request $request)
    {

        try {

            $userId = auth()->user()->id;
            $name = $request->input('name');
           
            $newGame= new Game();
            $newGame->name=$name;
            $newGame->userId=$userId;
            $newGame->save();

                return response()->json([
                    'success' => true,
                    'message' => "Game created"
                ], 201);
            } catch (\Throwable $th) {
            return response([
                'success' => false,
                'message' => "the game could not be created => " . $th->getMessage(),
            ], 500);
        }
    }


    public function getAllGames()
    {
        try {
            $games = Game::query()->get();
            return response()->json([
                'success' => true,
                'message' => 'Games retrieved',
                'data' => $games
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving games: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Could not retrieve games'
            ], 500);
        }
    }

    public function getGameByName($name)
    {
        try {
            $game = Game::where('name', $name)->get();

            return response()->json([
                'success' => true,
                'message' => 'Game retrieved',
                'data' => $game
            ]);
        } catch (\Throwable $th) {
            

            return response()->json([
                'success' => true,
                'message' => 'Could not retrieve game' . $th->getMessage()
            ], 500);
        }
    }

        public function updatedGame(Request $request, $id)
        {

    try{
            $userId = auth()->user()->id;
            
            $game = Game::find($userId);
            $game->name = $request->input('name');

            $game->save();
            
            return response([
                'success' => true,
                'message' => 'Game update successfully.'
            ], 200);
    }catch(\Throwable $th){

        return response()->json([
            'succes'=>false,
            'message'=>'The game could not updated'  . $th->getMessage()
        ],500);
    }

        }

    //public function updatedGame(Request $request)
    //{
    //    try {
    //        $userId = auth()->user()->id;

    //        $validator = Validator::make($request->all(), [
    //            'name' => 'required|max:255',

    //        ]);

    //        if ($validator->fails()) {
    //            return response([
    //                'success' => false,
    //                'message' => $validator->messages()
    //            ], 400);
    //        }

    //        $game = Game::find($userId);
    //        $game->name = $request->input('name');

    //        $game->save();

    //        return response([
    //            'success' => true,
    //            'message' => 'Datos del juego modificados correctamente.'
    //        ], 200);
    //    } catch (\Throwable $th) {
    //        Log::error($th->getMessage());
    //        return response([
    //            'success' => false,
    //            'message' => 'Error al modificar el juego.' . $th->getMessage()
    //        ], 500);
    //    }
    //}

    public function deleteGameByName($name)
    {
        try {
            $game = Game::where('name', $name)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Game deleted',
                'data' => $game
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving game: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Could not retrieve game'
            ], 500);
        }
    }
}
