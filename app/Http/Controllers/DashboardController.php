<?php

/*

Controller to handle the dashboard screen on the admin side

*/

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Posts;
use App\Models\AppFeedbacks;
use App\Models\Reports;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //function to load the dashboard with the charts data and neccesary data for the dashboard
    public function index(){

        // get total count number of for box value 

        $userCount = User::all()->count();
        $postCount = Posts::all()->count();
        $feedbackCount = AppFeedbacks::all()->count();
        $reportCount = Reports::all()->count();

        $dates = array();
        $postCountForChart = array();
        $userCountForChart = array();

        for($i = 0; $i < 5; $i++){
            // getting date
            $date = Carbon::now()->subDays($i)->toDateString();
            array_push($dates,$date);
            array_push($postCountForChart,$this->getPostsCountForDate($date));
            array_push($userCountForChart,$this->getUserCountForDate($date));

        }
        $dates = array_reverse($dates);
        $postCountForChart = array_reverse($postCountForChart);
        $userCountForChart = array_reverse($userCountForChart);

        //fake data for post chart
        $postData = [
            "labels"=>$dates,
            "posts"=>$postCountForChart,
        ];
        //fake data for user chart
        $userData = [
            "labels"=>$dates,
            "users"=>$userCountForChart,
        ];
        return view('layouts.admin.home',compact('postData','userData' ,'userCount','postCount','feedbackCount','reportCount'));
    }


    function getPostsCountForDate(String $data) : int {
        return Posts::where('created_at','like',"{$data}%")->count();
    }

    function getUserCountForDate(String $date) : int {
        return User::where('created_at','like',"{$date}%")->count();
    }
}
