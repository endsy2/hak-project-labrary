<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Admin credentials (move to .env in production)
    private const ADMIN_USERNAME = 'Senghak';
    private const ADMIN_PASSWORD = '062005';

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request (Single Admin Only)
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Verify hardcoded admin credentials
        if ($request->username === self::ADMIN_USERNAME && 
            $request->password === self::ADMIN_PASSWORD) {
            
            // Get or create the admin user
            $admin = User::firstOrCreate(
                ['email' => 'admin@library.com'],
                [
                    'name' => 'Admin Senghak',
                    'password' => Hash::make(self::ADMIN_PASSWORD)
                ]
            );

            // Log in the admin
            Auth::login($admin, $request->remember);
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid admin credentials',
        ])->onlyInput('username');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Show dashboard (protected)
     */
    public function dashboard()
    {
        // Additional security check
        if (auth()->user()->email !== 'admin@library.com') {
            abort(403, 'Admin access only');
        }
        
        return view('dashboard');
    }
}