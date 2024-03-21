<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    // user's own profile function
    static function myPosts(Request $request)
    {
        try {
            $data = json_decode($request->getContent());

            $userPosts = Posts::where('users_id', $data->id)->where("isAnonymous", false)->paginate(25, ["*"], 'page', $data->page);
            return response($userPosts);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }


    // getting current user's anonymous posts
    static function myAnonymousPosts(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $userPosts = Posts::where('users_id', $data->id)->where("isAnonymous", true)->paginate(25, ["*"], 'page', $data->page);
            return response($userPosts);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }


    static function userProfile(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            // Getting other user's profile to get his data for screen
            $userAccounts = User::where('id', $data->users_id)->first();
            // returning user's profile
            return response($userAccounts);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function usersPost(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $userPosts = Posts::where('users_id', $data->users_id)->where("isAnonymous", false)->paginate(25, ["*"], 'page', $data->page);
            return response($userPosts);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function updateMyProfile(Request $request){
        try{
            $data = json_decode($request->getContent());
            $user = User::find($data->id);
            $user->update([
                "firstName" => $data->firstName,
                "lastName" => $data->lastName,
                "email" => $data->email,
                "phoneNumber" => $data->phoneNumber
            ]);
            return response(["message" => "Profile updated successfully","user"=>$user]);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    static function changePassword(Request $request){
        try{
            $data = json_decode($request->getContent());

            $user = User::find($data->id);
            $user->password = Hash::make($data->password);
            $user->update();
            return response(["message" => "Password changed successfully"]);
            
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    // funciton to search user by their name
    static function searchUserByName(Request $request){
        try{

            $data =  json_decode($request->getContent());

            $users = User::where('firstName','like',"%{$data->search}%")->orWhere('lastName','like',"%{$data->search}%")->get();

            return response($users);

        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }
}
