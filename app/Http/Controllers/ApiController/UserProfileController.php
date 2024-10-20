<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Followers;
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
            $userPosts = Posts::where('users_id', $data->id)
                // ->where("isAnonymous", false)
                ->paginate(25, ["*"], 'page', $data->page);
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
            $user = auth()->guard('api')->user();

            $data = json_decode($request->getContent());
            // Getting other user's profile to get his data for screen
            $userAccounts = User::where('id', $data->users_id)->first();
            // returning user's profile

            $following = Followers::where('users_id', $userAccounts->id)->where("followerId", $user->id)->first();

            if ($following != null) {
                $isRequested = $following->isRequested;
                $isFollowing = $following->isFollowing;
            } else {
                $isRequested = 0;
                $isFollowing = 0;
            }


            return response(["userProfile" => $userAccounts, "isfollowing" => $isFollowing, "isRequested" => $isRequested]);
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

    static function updateMyProfile(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
            $user = User::find($data->id);
            $user->update([
                "firstName" => $data->firstName,
                "lastName" => $data->lastName,
                "email" => $data->email,
                "phoneNumber" => $data->phoneNumber
            ]);
            return response(["message" => "Profile updated successfully", "user" => $user]);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }


    // function to update profile picture
    static function updateProfilePicture(Request $request)
    {
        try {

            $user = $request->user();

            // upload user profile image if there is one
            if ($request->hasFile('profileImage')) {
                $destination = "public/profileImages";
                $image = $request->file('profileImage');
                $image_name = $image->getClientOriginalName();
                $image->storeAs($destination, $image_name);
                $baseUrl = url('');
                $imageUrl = $baseUrl . "/storage/profileImages/" . $image_name;
            }

            $updateUser = User::find($user->id);
            $updateUser->update(["profileImage" => $imageUrl]);

            return response(['status' => "success", 'message' => 'Profile picture updated', 'newImageUrl' => $imageUrl]);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    // function to update password
    static function changePassword(Request $request)
    {
        try {
            $data = json_decode($request->getContent());

            $user = User::find($data->id);

            if (Hash::check($data->oldPassword, $user->password)) {
                $user->password = Hash::make($data->password);
                $user->update();
                return response(["message" => "Password changed successfully"]);
            } else {
                return response(["message" => "Old password is incorrect"]);
            }
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    // funciton to search user by their name
    static function searchUserByName(Request $request)
    {
        try {

            $data =  json_decode($request->getContent());

            $users = User::select(['id', 'firstName', 'lastName', 'userName', 'profileImage'])
                ->where('id', '!=', auth()->id())
                ->where(function ($query)  use ($data) {
                    return $query->where('firstName', 'like', "%{$data->search}%")->orWhere('lastName', 'like', "%{$data->search}%")
                        ->orWhere('userName', 'like', "%{$data->search}%");
                })->paginate(25, ["*"], 'page', $data->page);

            $users->getCollection()->transform(function ($user) {
                $user->isFollowed = $user->isFollowed();
                $user->isRequested = $user->isRequested();
                return $user;
            });

            return response($users);
        } catch (Exception $exception) {
            return AuthController::handleExceptions($exception);
        }
    }

    // function to get current user's profile
    function getProfile(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
        ]);

        $data = json_decode($request->getContent(), true);

        $user = User::find($data['user_id']);

        if ($user) {
            $postCount = Posts::where('users_id', $user->id)->count();

            $followersCount = Followers::where('users_id', $user->id)->where('isFollowing', true)->count();

            $followingCount = Followers::where('followerId', $user->id)->where('isFollowing', true)->count();

            $user->postsCount = $postCount;
            $user->followersCount = $followersCount;
            $user->followingCount = $followingCount;

            // $response = [
            //     'user' => $user,
            // ];

            return response($user, 200);
        }

        return response(['message'=>'User profile not found.'],404);
    }
}
