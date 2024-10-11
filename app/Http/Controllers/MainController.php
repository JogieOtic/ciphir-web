<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;  // Import View facade
use Illuminate\Support\Facades\DB;    // Import DB facade
use Illuminate\Support\Facades\Hash;  // Import Hash facade
use Illuminate\Support\Facades\Session; // Import Session facade
use Illuminate\Support\Facades\Redirect; // Import Redirect facade
use App\Models\Admin;  // Import Admin model
use Illuminate\Support\Facades\Auth; // Import Auth facade


class MainController extends Controller
{
    public function main()
    {
        return view('pages.main');
    }

    public function login()
    {
        return view('pages.login');  // Ensure that you have a login Blade file in resources/views/pages/login.blade.php
    }
    public function submit(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find admin by username (note the correct case for 'Username' and 'Admin_ID')
        $admin = DB::table('Admin')->where('Username', $request->username)->first();

        // Check if admin exists and password matches
        if ($admin && Hash::check($request->password, $admin->Password)) {
            // Store admin information in session using correct column names
            session(['adminUsername' => $admin->Username, 'adminID' => $admin->Admin_ID]);

            // Login successful, redirect to the dashboard
            return redirect()->route('page.dashboard');
        } else {
            // Invalid credentials, redirect back with error message
            return redirect()->route('page.login')->withErrors(['loginError' => 'Invalid Credentials']);
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|confirmed', // Ensures the confirmation field matches
            'username' => 'required|string',
        ]);

        // Fetch current admin
        $admin = DB::table('Admin')->where('id', session('adminID'))->first();

        // Verify old password
        if (!Hash::check($request->oldPassword, $admin->Password)) {
            return back()->withErrors(['oldPassword' => 'Old password is incorrect.']);
        }

        // Update admin details
        DB::table('Admin')
            ->where('id', $admin->id)
            ->update([
                'username' => $request->username,
                'Password' => Hash::make($request->newPassword)
            ]);

        // Redirect with success message
        return back()->with('success', 'Successfully updated your profile.');
    }



    public function dashboard()
    {
        // Get the admin ID from session
        $adminID = session('adminID');

        // Fetch the admin from the database using the ID
        $admin = Admin::find($adminID);

        // Check if admin exists and fetch unread notifications
        $notifications = $admin ? $admin->unreadNotifications : [];

        // Get admin information from session
        $adminUsername = session('adminUsername');

        // Pass the notifications and admin username to the view
        return view('pages.dashboard', compact('notifications', 'adminUsername'));
    }


    /**
     * Display a listing of unread notifications for the logged-in admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification()
    {
        // Fetch unread notifications for the logged-in admin
        $user = Auth::user()->unreadNotifications;

        // Render the view for notifications and pass the notifications data
        return view('pages.dashboard', compact('notifications'));  // Ensure 'pages.notifications' exists
    }


    public function profile()
    {
        // Get admin information from session
        $adminUsername = session('adminUsername');

        // Pass admin data to the profile view
        return view('pages.profile', ['username' => $adminUsername]);
    }

    public function newReport()
    {
        // For now, just create a sample empty array or dummy data
        $reports = [
            (object)[
                'username' => 'Jogyo',
                'report_id' => '100001',
                'date' => '2024-07-10',
                'time' => '12:00 pm',
                'issue_type' => 'Exposed Wires',
                'infrastructure_type' => 'Electric Grids',
                'status' => 'On Process'
            ],
            (object)[
                'username' => 'Nad',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'Dia',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'Bia',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
        ]; // Dummy data until the database is ready

        // Pass the $reports variable to the view
        return view('pages.newreport', compact('reports'));
    }


    public function showPriorityReports()
    {
        $reports = [
            (object)[
                'username' => 'Jogyo',
                'report_id' => '100001',
                'date' => '2024-07-10',
                'time' => '12:00 pm',
                'issue_type' => 'Exposed Wires',
                'infrastructure_type' => 'Electric Grids',
                'severityLevel' => 'High', // Add severity level
                'status' => 'On Process'
            ],
            (object)[
                'username' => 'Nad',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'severityLevel' => 'Medium', // Add severity level
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'Dia',
                'report_id' => '100003',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'severityLevel' => 'Medium', // Add severity level
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'Bia',
                'report_id' => '100004',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'severityLevel' => 'Low', // Add severity level
                'status' => 'Pending'
            ],
        ];

        return view('pages.priorityreport', compact('reports'));
    }



    /**
     * Shows the report history page with all the reports from the database
     *
     * @return \Illuminate\Http\Response
     */
    public function reporthistory(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Fetch all reports, applying the search filter if provided
        $reports = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type')
            ->when($search, function ($query, $search) {
                return $query->where('User.username', 'like', "%{$search}%")
                            ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                            ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%");

            })
            ->get();

        // Pass the $reports variable to the view
        return view('pages.reporthistory', compact('reports'));
    }





    public function logout()
    {
        session()->forget(['adminUsername', 'adminID']);
        return redirect()->route('page.login');
    }

}
