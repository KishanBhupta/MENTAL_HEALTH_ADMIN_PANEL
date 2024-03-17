<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;

class CommentsController extends Controller
{
   static function getAllComments(){
    $comments = Comments::all();
    return responce($comments,200);

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
        return response(['message' => $message, 'status' => 'error'], $statusCode);
    }
}
