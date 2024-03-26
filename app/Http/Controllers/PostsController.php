<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController\AuthController;
use App\Models\SavedPosts;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;

class PostsController extends Controller
{
    static function getPost(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $post = Posts::paginate(25, ["*"], 'page', $data->page);
            return response($post);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function createPost(Request $request)
    {
        try {
            $post = json_decode($request->getContent());
            $data = [];
            $data['users_id'] = $post->users_id;
            // $data['imageUrl'] = $post->imageUrl;
            $data['postText'] = $post->postText;
            $data['postDescription'] = $post->postDescription;
            $data['isAnonymous'] = $post->isAnonymous;
            $data['likes'] = 0;
            $data['postStatus'] = 1;

            if($post->hasFile('imageUrl')){
                $destination = "public/postsImages";
                $image = $request->file('imageUrl');
                $image_name = $image->getClientOriginalName();
                $image->storeAs($destination,$image_name);
                $baseUrl = url('');
                $data['imageUrl'] = $baseUrl."/storage/postsImages/".$image_name;
            }

            Posts::create($data);
            return response(['message' => 'Post Created '], 200);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function deletePost($id)
    {
        try {
            $post = Posts::Find($id);
            $post->delete();
            // return response($post);
            return response(['message' => "Post delete Sucessflly "], 200);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function addLike($id)
    {
        try {
            $post = Posts::Find($id);
            $post->update(["likes" => $post->likes + 1]);
            return response(['message' => "Like Added "], 200);
        } catch (Exception $exception) {
            AuthController::handleExceptions($exception);
        }
    }

    static function removeLike($id)
    {
        try {
            $post = Posts::Find($id);
            $post->update(["likes" => $post->likes - 1]);
            return response(['message' => "Like Removed "], 200);
        } catch (Exception $exception) {
            AuthController::handleExceptions($exception);
        }
    }

    static function savePost(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            SavedPosts::create([
                "users_id" => $data->users_id,
                "posts_id" => $data->posts_id
            ]);
            return response(["message" => "Post Saved Successfully"]);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function unSavePost(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $post = SavedPosts::where(['users_id' => $data->users_id, 'posts_id' => $data->posts_id])->first();
            $post->delete();
            return response(["message"=>"Post unsaved successfully"]);
        } catch (Exception $exception) {
            AuthController::handleExceptions($exception);
        }
    }

    static function getSavedPosts(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $posts = SavedPosts::paginate(25, ["*"], 'page', $data->page)->where(['users_id' => $data->id]);
            return response($posts);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }
}
