<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController\AuthController;
use App\Models\Followers;
use Exception;
use Illuminate\Http\Request;

class FollowersController extends Controller
{


    // send following request
    static function sendFollowingRequest(Request $request)
    {

        try {
            $follower = json_decode($request->getContent());

            $data['users_id'] = $follower->users_id;
            $data['followerId'] = $follower->follower_id;
            $data['isFollowing'] = false;
            $data['isRequested'] = true;

            Followers::create($data);

            return response(['status' => 'success', 'message' => 'Request Sent Successfully']);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    // add new follower
    static function acceptFollowRequest(Request $request)
    {
        try {
            $data = json_decode($request->getContent());

            $follower = Followers::where(['users_id' => $data->users_id, 'followerId' => $data->follower_id])->first();

            $follower->update([
                "isFollowing" => true,
                "isRequested" => false,
            ]);

            return response(['status' => 'success', 'message' => 'Request Accepted']);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function getFollowersCount($id)
    {

        try {
            $followersCount = Followers::where("users_id", $id)->count();
            return response(['status' => 'success', 'followers_count' => $followersCount]);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    static function removeRequestOrRemoveFollower(Request $request)
    {

        try {
            $data = json_decode($request->getContent());

            $follower = Followers::where(["users_id" => $data->users_id, "followerId" => $data->follower_id])->first();

            $follower->delete();

            return response(['status' => 'success', 'message' => 'Follower Removed']);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }
}
