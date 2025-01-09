<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if(Auth::check()){
            return Auth::User()->Role === 'SA' ? redirect()->route('sa.dashboard'): redirect()->route('admin.dashboard');
            
        }
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // php artisan config:clear
        // php artisan route:clear
        // php artisan cache:clear
        // php artisan view:clear

        $admin = Admin::where('Username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->Password)) {
            Auth::login($admin);
            $redirectUrl = $request->input('next') 
            ? $request->input('next') 
            : ($admin->Role === 'SA' ? '/sa-dashboard' : '/dashboard');
            return redirect($redirectUrl); // Redirect to the admin dashboard
        }

        return back()->withErrors(['error' => 'Invalid username or password.']);
    }

    public function logout()
    {
        Auth::logout(); // Log out the authenticated user
        request()->session()->invalidate(); // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('page.main'); // Redirect to login page
    }
}
