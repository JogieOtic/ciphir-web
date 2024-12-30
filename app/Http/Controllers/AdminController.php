<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function checkAuth(){
        if (Auth::User()->Role === 'SA'){
            return redirect('/unauthorized');
        }
        return null;
    }
    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login', ['next' => '/dashboard']);
        }
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        // Get the logged-in user's ID
        // $userId = Auth::User()->Username; // Alternatively, Auth::user()->id
        // $user = Auth::User();
        // return view('pages.index', compact('user'));
        $adminID = session('adminID');

    // Fetch admin details
    $admin = Admin::find($adminID);

    // Fetch unread notifications
    $notifications = $admin ? $admin->unreadNotifications : [];

    // Fetch statistics for the dashboard
    $registeredUsers = DB::table('User')->count();

    $reportsToday = DB::table('Reported_Issue')
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->count();

    $resolvedReports = DB::table('Reported_Issue')
                        ->where('reportStatus', 'Resolved')
                        ->whereMonth('created_at', date('m'))
                        ->count();

    $unresolvedReports = DB::table('Reported_Issue')
                            ->whereIn('reportStatus', ['Pending', 'In Progress'])
                            ->count();

    // Fetch infrastructure report counts
    $infrastructureReports = DB::table('Reported_Issue')
                                ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                                ->select('Infrastructure.infrastructure_type as name', DB::raw('COUNT(*) as total'))
                                ->groupBy('Infrastructure.infrastructure_type')
                                ->orderBy('total', 'desc')
                                ->get();
    $user = Auth::User();
    // Pass all required variables to the view
    return view('pages.index', compact(
        'notifications',
        'registeredUsers',
        'reportsToday',
        'resolvedReports',
        'unresolvedReports',
        'infrastructureReports',
        'user'
    ));
    }
}
