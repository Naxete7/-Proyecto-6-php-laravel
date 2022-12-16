<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    public function getAllUsers()
    {

        try {
            $Users = User::get();

            return response([
                'success' => true,
                'message' => 'All Users retrieved successfully',
                'data' => $Users
            ], 200);
        } catch (\Throwable $th) {

            return response([
                'success' => false,
                'message' => "Users' info could not be gotten"
            ], 500);
        }
    }

    // Delete User

    public function deleteUser(Request $request)
    {
        try {

            $user = $request->input("id");
            $user->delete();

        } catch (\Throwable $th) {
            return response([
                'success' => false,
                'message' => "Trying to delete a User but something went wrong"
            ], 500);
        }
    }

    //update users

    //public function updateUser(Request $request,$id)
    //{

    //    try {

    //        $user = auth()->user()->id;
    //        $newName=$request->input('name');

    //        $updateUser = User::where('name')
    //        ->where('id', $id)
    //            ->update([
    //            'name' => $newName,
    //            ]);


    //        if (!$updateUser) {
    //            return response()->json([
    //                "success" => true,
    //                "message" => "User doesnt exists"
    //            ], 404);

    //        return response([
    //            'succes' => true,
    //            'message' => 'User updated successfully',
    //            'data' => $user

    //        ], 200);
    //    }
    //    } catch (\Throwable $th) {
    //        return response([
    //            'succes' => false,
    //            'message' => 'User could not be update' . $th->getMessage()
    //        ], 500);
    //    }
    //}

    public function updateUser(Request $request)
    {
        try {
            $userId = auth()->user()->id;

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $user = User::find($userId);
            $user->name = $request->input('name');
            
            $user->save();

            return response([
                'success' => true,
                'message' => 'Datos del jugador modificados correctamente.'
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al modificar los datos del jugador.'
            ], 500);
        }
    }

}
