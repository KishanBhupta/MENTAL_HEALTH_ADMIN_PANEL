<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userReports = Reports::with(['user', "reportedUser"])->where([
            "reports.reportedPostId" => NULL,
            "reports.reportedCommentId" => NULL,
        ])->get()->reverse();

        $postReports = Reports::with(['user', 'reportedPosts'])->where([
            "reports.reportedUserId" => NULL,
            "reports.reportedCommentId" => NULL,
        ])->get()->reverse();


        $commentReports = Reports::with(['user', 'reportedComment'])->where([
            "reports.reportedPostId" => NULL,
            "reports.reportedUserId" => NULL,
        ])->get()->reverse();

        // dd($commentReports);
        return view(
            'layouts.admin.reports',
            compact(
                'postReports',
                'commentReports',
                'userReports'
            )
        );
    }
    //function to approve user reports
    function approveUserReport($id)
    {
        //changing user block status
        $user = User::find($id);
        $user->isBlocked = true;
        $user->save();

        //change report status to approved
        Reports::where('reportedUserId', $id)->update([
            'reportStatus' => 'Approved'
        ]);

        return redirect()->back();
    }

    //function to delete user reports
    function deleteUserReport($id)
    {

    }

    //function to unblock user 
    function unblockUserReport($id){
        User::where('id', $id)->update(["isBlocked" => false]);
        Reports::where('reportedUserId', $id)->update(['reportStatus' => 'Rejected']);
        return redirect()->back();
    }
    //function to approve post reports
    function approvePostReport($id)
    {
        Posts::where('id', $id)->update(["postStatus" => false]);
        Reports::where('reportedPostId', $id)->update(["reportStatus" => "Approved"]);
        return redirect()->back();
    }
    //function to delete post reports
    function deletePostReport($id)
    {
        Posts::where('id', $id)->update(["postStatus" => true]);
        Reports::where('reportedPostId', $id)->update(["reportStatus" => "Rejected"]);
        return redirect()->back();
    }
    //function to approve comment reports
    function approveCommentReport($id)
    {
        Comments::where('id', $id)->update(["commentStatus" =>false]);
        Reports::where('reportedCommentId', $id)->update(["reportStatus"=>"Approved"]);
        return redirect()->back();
    }
    //function to delete comment reports
    function deleteCommentReport($id)
    {
        Comments::where('id', $id)->update(["commentStatus" =>true]);
        Reports::where('reportedCommentId', $id)->update(["reportStatus" => "Rejected"]);
        return redirect()->back();
    }
}
