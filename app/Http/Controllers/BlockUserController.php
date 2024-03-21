<?php

namespace App\Http\Controllers;

use App\Models\BlockUser;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\ApiController\AuthController;

class BlockUserController extends Controller
{
    // function to add new block user
    static function addBlockUser(Request $request){
        try{
            $data = json_decode($request->getContent());

            BlockUser::create([
                "users_id" => $data->users_id,
                "block_users_id" => $data->block_user_id,
                "status" => true
            ]);

            return response([
                "status" =>"success",
                "message" => "Block user added successfully",
            ],200);
        }
        catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    // function to show blocked users
    static function showBlockUsers($id){
        try{

            $blockedUsers = BlockUser::where("users_id",$id)->with('blockedUser')->get();

            return response($blockedUsers);

        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    static function unblockUser(Request $request){
        try{
            $data = json_decode($request->getContent());

            $blockedUser = BlockUser::where("users_id",$data->users_id)->where("block_users_id",$data->block_user_id)->first();

            $blockedUser->delete();

            return response([
                "status"=>"success",
                "message"=>"User Unblocked Succesfully"
            ]);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }
}
