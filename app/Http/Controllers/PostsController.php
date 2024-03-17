<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController\AuthController;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;

class PostsController extends Controller
{
static function getPost(){
    $post = Posts::all();
     return response()->json($post);
}

static function createPost(Request $request){
    try{
        $post = json_decode($request->getContent());
        $data = [] ; 

        $data['users_id'] = $post->users_id;
        $data['imageUrl'] = $post->imageUrl;
        $data['postText'] = $post->postText;
        $data['postDescription'] = $post->postDescription;
        $data['isAnonymous'] = $post->isAnonymous;
        $data['likes'] = $post->likes;
        $data['postStatus'] = $post->postStatus;

        Posts::create($data);
        return response(['message' => 'Post Created '], 200);

    }
     catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function deletePost($id){
        try{
            $post = Posts::Find($id);
            $post->delete();
            // return response($post);
            return response(['message' => "Post delete Sucessflly "], 200);
    }
      catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }
}
