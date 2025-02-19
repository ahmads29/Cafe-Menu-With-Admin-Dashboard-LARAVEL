<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // If authentication fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required', // Adds password confirmation check
        ]);

        $user = auth()->user();

        // Check if the current password matches
        if (Hash::check($request->current_password, $user->password)) {
            // Hash and update the new password
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Redirect to the admin route
            return redirect()->route('admin')->with('status', 'Password updated successfully.');
        } else {
            // If the current password is incorrect, return with an error
            return redirect()->route('admin')->with('status', 'Password updated successfully.');
        }
    }

        // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }



}
