<?php

namespace App\Http\Controllers;

use App\Models\AppFeedbacks;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;

class AppFeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = AppFeedbacks::with('user')->get()->reverse();
        // dd($feedbacks); 
        return view('layouts.admin.index', compact('feedbacks'));
    }


 static function storeFeedback(Request $request){
    try {
        $feedback = json_decode($request->getContent());

        $data = [
            'users_id' => $feedback->users_id,
            'feedbackData' => $feedback->feedbackData,
            'feedbackRating' => $feedback->feedbackRating
        ];
        
        $newFeedback = AppFeedBacks::create($data);

        return response(['message' => 'Feedback created successfully'], 200);
    } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
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
            // case 23000:
            //     $message = "User with same email already exists";
            //     $statusCode = 422;
            //     break;
            default:
                $message = "The requested page does not exist";
                $statusCode = 500;
                break;
        }
        return response(['message' => $message, 'status' => 'error'], $statusCode);
    }

}
