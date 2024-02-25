<?php

namespace App\Http\Controllers;

use App\Models\AppFeedbacks;
use Illuminate\Http\Request;

class AppFeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = AppFeedbacks::with('user')->get()->reverse();
        return view('layouts.admin.index', compact('feedbacks'));
    }

}
