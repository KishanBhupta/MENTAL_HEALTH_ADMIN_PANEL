<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use App\Http\Controllers\ApiController\AuthController;
use App\Models\Posts;
use App\Models\commentLike;

class CommentsController extends Controller
{
    static function getAllComments(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $comments = Comments::with(['commentUser','withLikes'])->where(["posts_id"=>$data->post_id])->paginate(25, ["*"], 'page', $data->page);
            return response($comments, 200);
        } catch (Exception $e) {
            return CommentsController::handleExceptions($e);
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
            $isAnonymous = $data->isAnonymous;


            Comments::create([
                "users_id"=>$userId,
                "posts_id"=>$data->post_id,
                "commentDescription"=>$data->commentDescription,
                "isAnonymous"=>$isAnonymous,
                "likes"=>0,
                "commentStatus"=>0,
            ]);

            $post = Posts::find($data->post_id);

            $post->update([
                "comments"=>$post->comments+1
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

            $post = Posts::find($comment->posts_id);

            $post->update([
                "comments"=>$post->comments-1
            ]);

            // delete commen like from comment like table
            commentLike::where(['comment_id' => $id])->delete();
            //delete comment
            $comment->delete();

            return response([
                "status"=>"successs","message"=>"Comment deleted successfully"
            ]);
        }catch(Exception $exception){
            return AuthController::handleExceptions($exception);
        }
    }

    // function to add like to comment

     static function likeComment(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $comment = Comments::Find($data->comment_id);

            $comment->update(["likes" => $comment->likes + 1]);

            commentLike::create([
                "comment_id" => $data->comment_id,
                "users_id" => $data->user_id
            ]);
            return response(['message' => "Like Added "], 200);
        } catch (Exception $exception) {
            AuthController::handleExceptions($exception);
        }
    }
    // function to remove like from comment
    static function dislikeComment(Request $request){
        try {
           $data = json_decode($request->getContent());
            $comment = Comments::Find($data->comment_id);

            $comment->update(["likes" => $comment->likes - 1]);

           commentLike::where(['comment_id' => $data->comment_id, 'users_id'=>$data->user_id])->first()->delete();

            return response(['message' => "Like Removed "], 200);
        } catch (Exception $exception) {
            AuthController::handleExceptions($exception);
        }
    }
}


