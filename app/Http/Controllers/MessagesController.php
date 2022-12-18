<?php

namespace App\Http\Controllers;

use App\Models\Message;

use Illuminate\Http\Request;


class MessagesController extends Controller
{


    public function postMessage(Request $request)
    {
        try {

            $userId = auth()->user()->id;
            $message = $request->input('message');
            $partiesId = $request->get('partiesId');

            $newMessage = new Message();
            $newMessage->userId = $userId;
            $newMessage->partiesId = $partiesId;
            $newMessage->message = $message;
            $newMessage->save();

            return response([
                'succes' => true,
                'message' => 'Message sent successfully',
                'text' => $message

            ], 200);
        } catch (\Throwable $th) {

            return response([
                'success' => false,
                'message' => 'Could not send message.' . $th->getMessage()
            ], 500);
        }
    }

    public function deleteMessage($id)
    {
        try {
            $messageId = $id;
            $message = Message::query()->find($messageId);

            if (!$message) {
                return response([
                    'succes' => true,
                    'message' => 'Message not found'
                ], 200);
            }
            $message->delete();
            return response([
                'succes' => true,
                'message' => 'Message delete succesfully'
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'succes' => false,
                'message' => 'Error deleting message'
            ], 500);
        }
    }

    public function updateMessage(Request $request, $id)
    {
        try {
            $userId = auth()->user()->id;
            $messageId = $id;
            $message = Message::find($messageId);
            $message->message = $request->input('message');
            $message->save();

            return response([
                'succes' => true,
                'message' => 'Message update succesfully'
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'succes' => false,
                'message' => 'The message could not update' . $th->getMessage()
            ], 500);
        }
    }

    public function getAllMessages()
    {
        try {
            $message = Message::query()->get();
            return response()->json([
                'success' => true,
                'message' => 'Messages retrieved',
                'data' => $message
            ]);
        } catch (\Throwable $th) {
          

            return response()->json([
                'success' => true,
                'message' => 'Could not retrieve messages'
            ], 500);
        }
    }

    public function AllMessagesByPartiesId($partiesId)
    {
        try {
            $message = Message::where('partiesId', $partiesId)->get();
            return response()->json([
                'success' => true,
                'message' => 'Messages retrieved',
                'data' => $message
            ]);
        } catch (\Throwable $th) {


            return response()->json([
                'success' => true,
                'message' => 'Could not retrieve messages'
            ], 500);
        }
    }

}
