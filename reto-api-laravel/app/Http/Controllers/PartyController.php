<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    
public function createParty(Request $request){

try{ 
    $userid=auth()->user()->id;

    $party=Party::create([

        'title'=>$request->get('title'),
        'gameId'=>$request->get('gameId'),

    ]);
            //$party->users()->attach($userId);
            return response([
                'success' => true,
                'message' => 'Has entrado al chat correctamente.'
            ], 200);
}catch (\Throwable $th){

            return response([
                'success' => false,
                'message' => 'No has podido acceder al chat.' . $th->getMessage()
            ], 500);
}


}

public function exitParty(Request $request)
{
try{
    $userId=auth()->user()->id;

            $party = Party::create([
                'gameId' => $request->get('gameId'),
                'title' => $request->get('title'),
                
            ]);

            //$party->users()->attach($userId);

            return response([
                'success' => true,
                'message' => 'Has salido del chat correctamente.'
            ], 200);
        } catch (\Throwable $th) {
           
            return response([
                'success' => false,
                'message' => 'No has podido salir del chat.'  . $th->getMessage()
            ], 500);
        }

}


}


