<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
   

public function postMessage(Request $request)
{
try{
    $gameId=$request->input('gameId');
    $message=$request->input('message');

            $newMessage= new Message();
            $newMessage->gameId=$gameId;
            $newMessage->message=$message;
            $newMessage->save();

            return response([
                'succes'=>true,
                'message'=> 'Message sent successfully',
                'text'=>$message
                
            ],200);

} catch (\Throwable $th) {
         
            return response([
                'success' => false,
                'message' => 'Error al enviar el mensaje.' . $th->getMessage()
            ], 500);
        }

}




}
