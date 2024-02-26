<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;

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
        $admin = Admin::first(); // Assuming admin is authenticated

        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        // Check if the old password matches the one stored in the database
        if ($validatedData['old_password'] !== $admin->adminPassword) {
            return redirect()->back()->with('error', 'The old password is incorrect.');
        }
    
        // Update admin password
        $admin->adminPassword = $validatedData['password'];
        $admin->save();
        return redirect()->back()->with('success', 'password is successfully updated.'); // Redirect back to the same page
    }        
}
