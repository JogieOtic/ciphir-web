<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function checkAuth(){
        if (Auth::User()->Role === 'A'){
            return redirect('/unauthorized');
        }
        return null;
    }
    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login', ['next' => '/sa-dashboard']);
        }
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $users = Admin::all();

        $adminClients = DB::table('User')
                        ->count();

        $admins = DB::table('Admin')
                        ->where('Role', 'A')
                        ->count();

        $infrastructures = DB::table('Infrastructure')
                        ->count();

        $issues = DB::table('Issues')
                        ->count();

        $reports = DB::table('Reported_Issue')
                        ->count();

        $user = Auth::user();
        // return response()->json([$users, $user, $adminClients, $admins, $infrastructures, $issues]);
        return view('sa-admin.index', compact('users', 'user', 'adminClients', 'admins', 'infrastructures', 'issues', 'reports'));
    }
}
