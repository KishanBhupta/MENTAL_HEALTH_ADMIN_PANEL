<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function show()
    {
        $admin = Admin::all();
        return view('layouts.admin.show', compact('admin'));
    }

    public function edit()
    {
        $admin = Admin::first(); 
        return view('layouts.admin.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Admin::all();
        $admin->update($request->all());
        return redirect()->route('layouts.admin.show')->with('success', 'Profile updated successfully');
    }
}
