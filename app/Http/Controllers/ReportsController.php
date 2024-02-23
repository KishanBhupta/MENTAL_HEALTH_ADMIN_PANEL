<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userReports = Reports::with(['user',"reportedUser"])->where([
            "reports.reportedPostId"=>NULL,
            "reports.reportedCommentId"=>NULL,
        ])->get();

        $postReports = Reports::with(['user','reportedPosts'])->where([
            "reports.reportedUserId"=>NULL,
            "reports.reportedCommentId"=>NULL,
        ])->get();

        
        $commentReports = Reports::with(['user','reportedComment'])->where([
            "reports.reportedPostId"=>NULL,
            "reports.reportedUserId"=>NULL,
        ])->get();

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reports $reports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reports $reports)
    {
        //
    }
}
