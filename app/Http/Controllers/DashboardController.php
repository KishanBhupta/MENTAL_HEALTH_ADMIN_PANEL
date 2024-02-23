<?php

/*

Controller to handle the dashboard screen on the admin side

*/

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Posts;
use App\Models\AppFeedbacks;
use App\Models\Reports;



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

        

        //fake data for post chart
        $postData = [
            "labels"=>["01-01-2023","02-01-2023","03-01-2023","04-01-2023","05-01-2023","06-01-2023"],
            "posts"=>[10,14,9,12,5,20],
        ];
        //fake data for user chart
        $userData = [
            "labels"=>["01-01-2023","02-01-2023","03-01-2023","04-01-2023","05-01-2023","06-01-2023"],
            "users"=>[15,20,35,44,50,65],
        ];
        return view('layouts.admin.home',compact('postData','userData' ,'userCount','postCount','feedbackCount','reportCount'));
    }
}
