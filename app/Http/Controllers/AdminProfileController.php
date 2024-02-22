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
        // dd($admin);
        return view('layouts.admin.show', compact('admin'));
    }

    public function edit()
    {
        // $admin = Admin::all();
        // return view('admin.profile.edit', ['layouts.admin' => $admin]);
        $admin = Admin::first(); // Assuming you have at least one admin record in the database
        return view('layouts.admin.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Admin::first();
        $admin->update($request->all());
        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully');
    }
}



// public function update(Request $request, $id)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required',
//             'description' => 'required',
//             'price' => 'required|numeric',
//         ]);

//         $product = Product::findOrFail($id);
//         $product->update($validatedData);
//         return redirect('/products');
//     }