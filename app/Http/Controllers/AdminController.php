<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function adlogin(){
        return view('layouts.admin.adminlogin');
     }
 
     public function getData(Request $request){
         $request->validate([
             'adminEmail' => 'required|email',
             'adminPassword' => 'required',
         ]);

         $adminEmail = $request->input('adminEmail');
         $adminPassword = $request->input('adminPassword');
 
         $admin = Admin::where('adminEmail', $adminEmail)->first();
 
         if($admin && $admin->adminPassword === $adminPassword){
            // Authentication passed...
            $request->session()->put('adminEmail', $adminEmail);
            return redirect('/'); // Redirect to the desired page after successful login
        }
        else{
            // Invalid credentials
            return redirect()->back()->withErrors(['adminEmail' => 'Incorrect email or password.']);
        }
     }
    public function logout()
    {
        return view('layouts.admin.adminlogin');
    }
}
