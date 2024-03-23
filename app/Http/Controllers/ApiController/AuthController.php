<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AppFeedBacks;
use App\Models\Posts;


use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = $request;

            $data = [];

            $data['firstName'] = $user->firstName;
            $data['lastName'] = $user->lastName;
            $data['email'] = $user->email;
            $data['phoneNumber'] = $user->phoneNumber;
            $data['password'] = Hash::make($user->password);
            $data['isBlocked'] = $user->isBlocked;
            $data['userName'] = $user->userName;

            // upload user profile image if there is one 
            if($user->hasFile('profileImage')){
                $destination = "public/profileImages";
                $image = $request->file('profileImage');
                $image_name = $image->getClientOriginalName();
                $image->storeAs($destination,$image_name);
                $baseUrl = url('');
                $data['profileImage'] = $baseUrl."/storage/profileImages/".$image_name;
            }
            
            User::create($data);

            return response(['status'=>'success','message' => 'User created successfully'], 200);

        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    public function signIn(Request $request)
    {
        $user = json_decode($request->getContent());

        $auth = auth()->attempt(["email" => $user->email, "password" => $user->password]);



        if ($auth) {
            $authUser = User::firstWhere(['email' => $user->email]);
            if (Hash::check($user->password, $authUser->password)) {
                $token = $authUser->createToken('access-token')->accessToken;
                return response(["user" => $authUser, "token" => $token], 200);
            }
        } else {
            return response(["message" => "Invalid User Credentials"], 401);
        }
    }

    public function login(Request $request)
    {
        $user = auth()->guard('api')->user();
        return response($user, 200);
    }


    static function handleExceptions(Exception $exception)
    {
        $exceptionCode = $exception->getCode();
        $message = "";
        $statusCode = 0;
        switch ($exceptionCode) {
            case 404:
                $message = "The requested page does not exist";
                $statusCode = 404;
                break;
            case 500:
                $message = "Something went wrong!, please try again later.";
                $statusCode = 500;
            case 23000:
                $message = "User with same email already exists";
                $statusCode = 422;
                break;
            default:
                $message = "The requested page does not exist";
                $statusCode = 500;
                break;
        }
        return response(['message' => $message, 'exception'=>$exception , 'status' => 'error'], $statusCode);
    }

}
