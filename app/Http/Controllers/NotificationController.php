<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController\AuthController;
use App\Models\Notification;
use Illuminate\Http\Request;
use Exception;

class NotificationController extends Controller
{
  
    // function to add notification in database
    static function addNotification(Request $request){
        try{
            $data = json_decode($request->getContent());

            Notification::create([
                "users_id"=>$data->user_id,"title"=>$data->title,"body"=>$data->body
            ]);

            return response(['status' =>'success','message'=>'Notification added'],200);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

}
