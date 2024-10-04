<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        return view('pages.main');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function handleLogin(Request $request)
    {
        // Simple validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Sample login logic (replace this with real authentication)
        if ($request->email === 'admin@example.com' && $request->password === 'password123') {
            // Redirect to dashboard on successful login
            return redirect()->route('page.dashboard');
        } else {
            // Return back to login page with error message on failure
            return redirect()->route('page.login')->withErrors(['loginError' => 'Invalid Credentials']);
        }
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function newreport()
    {
        return view('pages.newreport');
    }

    public function priorityreport()
    {
        return view('pages.priorityreport');
    }

    public function reporthistory()
    {
        return view('pages.reporthistory');
    }
}
