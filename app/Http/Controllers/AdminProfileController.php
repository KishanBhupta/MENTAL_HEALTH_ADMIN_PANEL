<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated admin using the session email
        $adminEmail = session('adminEmail');
        $admin = Admin::where('adminEmail', $adminEmail)->first();

        // Check if admin is authenticated and exists
        if ($admin) {
            return view('layouts.admin.show', compact('admin'));
        } else {
            // Admin not found, handle the case accordingly
            return redirect()->route('admin.logout')->with('error', 'Admin not found.');
        }
    }

    public function edit()
    {
        // Retrieve the authenticated admin using the session email
        $adminEmail = session('adminEmail');
        $admin = Admin::where('adminEmail', $adminEmail)->first();

        // Check if admin is authenticated and exists
        if ($admin) {
            return view('layouts.admin.edit', compact('admin'));
        } else {
            // Admin not found, handle the case accordingly
            return redirect()->route('admin.logout')->with('error', 'Admin not found.');
        }
    }


    public function update(Request $request)
    {
        // Retrieve the authenticated admin using the session email
        $adminEmail = session('adminEmail');
        $admin = Admin::where('adminEmail', $adminEmail)->first();

        // Check if admin is authenticated and exists
        if ($admin) {
            // Validate the request data
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
            ]);

            // Check if the old password matches the one stored in the database
            if ($request->old_password !== $admin->adminPassword) {
                return redirect()->back()->with('error', 'The old password is incorrect.');
            }

            // Update admin password
            $admin->adminPassword = $request->password;
            $admin->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            // Admin not found, handle the case accordingly
            return redirect()->route('admin.logout')->with('error', 'Admin not found.');
        }
    }

   
}
