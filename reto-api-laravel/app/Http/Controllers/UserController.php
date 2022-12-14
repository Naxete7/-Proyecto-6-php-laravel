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
        Log::info("Getting all Users");
        try {
            $Users = DB::table('users')->get();

            return response([
                'success' => true,
                'message' => 'All Users retrieved successfully',
                'data' => $Users
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => "Users' info could not be gotten"
            ], 500);
        }
    }




    // Delete User

    public function deleteAUser(Request $request)
    {
        try {
            Log::info("Deletting a User");

            $UserId = $request->input("id");
        } catch (\Throwable $th) {
            Log::info("Trying to delete a User but something went wrong " . $th->getMessage());
        }
    }



//update users

public function updateUsers(Request $request)
{

    try{
    $user = auth()->user();
    
 $username = ($request->username !== null) ? $request->username : $user->username;

    $user->username=$username;
    $user->save();


return response([
    'succes'=>true,
    'message'=> 'User updated successfully',
    'data'=>$user
],200);

} catch (\Throwable $th) {
    return response ([
        'succes'=>false,
        'message'=> 'User could not be update'
    ],500);
}

}








}
