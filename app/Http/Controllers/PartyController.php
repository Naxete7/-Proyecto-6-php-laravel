<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
class PartyController extends Controller
{
    
public function createParty(Request $request){

try{ 
  

    $party=Party::create([

        'title'=>$request->get('title'),
        'gameId'=>$request->get('gameId'),

    ]);
           
            return response([
                'success' => true,
                'message' => 'You have entered the chat successfully.'
            ], 200);
}catch (\Throwable $th){

            return response([
                'success' => false,
                'message' => 'You could not access the chat.' . $th->getMessage()
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


            return response([
                'success' => true,
                'message' => 'You have successfully exited the chat.'
            ], 200);
        } catch (\Throwable $th) {
           
            return response([
                'success' => false,
                'message' => 'You could noy get out of the chat'  . $th->getMessage()
            ], 500);
        }

}


}


