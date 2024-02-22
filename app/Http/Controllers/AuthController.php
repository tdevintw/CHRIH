<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Models\Category;

class AuthController
{
    public function register()
    {    $categories= Category::all();
        return view('Auth.register',compact('categories'));
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('voyager.login')->with('success', 'Registration successful! Please login.');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
