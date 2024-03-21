<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use App\Http\Controllers\ApiController\AuthController;
use App\Models\Posts;

class CommentsController extends Controller
{
    static function getAllComments()
    {
        $comments = Comments::all();
        return response($comments, 200);
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

    // function to add comment
    static function addComment(Request $request){
        try{

            $data = json_decode($request->getContent());

            $userId = $data->users_id;
            $likes = $data->likes;
            $commentStatus = $data->commentStatus;
            $isAnonymous = $data->isAnonymous;

            
            Comments::create([
                "users_id"=>$userId,
                "posts_id"=>$data->post_id,
                "commentDescription"=>$data->commentDescription,
                "isAnonymous"=>$isAnonymous,
                "likes"=>$likes,
                "commentStatus"=>$commentStatus,
            ]);


            return response([
                "status"=>"successs","message"=>"Comment created successfully"
            ],200);


        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }
    
    // function to delete comment
    static function deleteComment($id){
        try{
            $comment = Comments::find($id);
            $comment->delete();

            return response([
                "status"=>"successs","message"=>"Post deleted successfully"
            ]);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    // function to add like to comment
    static function likeComment($id){
        try{
            $comment = Comments::find($id);
            $comment->update([
                "likes"=>($comment->likes??0)+1
            ]);

            return response(['status'=>"successs","message"=>"Comment Like added successfully"]);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    // function to remove like from comment
    static function dislikeComment($id){
        try{
            $comment = Comments::find($id);
            $comment->update([
                "likes"=>($comment->likes??0)-1
            ]);
            
            return response(['status'=>"successs","message"=>"Comment Dislike added successfully"]);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }
}


