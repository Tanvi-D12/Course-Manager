<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check credentials
        if ($validated['username'] === 'admin@123' && $validated['password'] === 'admin@123') {
            session(['admin_authenticated' => true]);
            return redirect('/admin')->with('success', 'Login successful');
        }

        return back()->with('error', 'Invalid credentials');
    }

    /**
     * Handle admin logout
     */
    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
