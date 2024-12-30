<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{

    public function main()
    {
        return view('pages.main');
    }
    public function unauthorized(){
        if (Auth::User()->Role === 'A' || Auth::User()->Role === 'SA'){
            $message = [
                'message' => 'You do not have access to this page.',
                'forbidden' => 'Unauthorized 403 Forbidden',
            ];
            return view('unauthorized', compact('message'));
        }// 403 Forbidden status code        
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
//******************************************************************************* */
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

//********************************************************************************** */

public function dashboard()
{
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

    // Pass all required variables to the view
    return view('pages.dashboard', compact(
        'notifications',
        'registeredUsers',
        'reportsToday',
        'resolvedReports',
        'unresolvedReports',
        'infrastructureReports'
    ));
}





//********************************************************************************************8 */
    public function profile()
    {
        // Get admin information from session
        $adminUsername = session('adminUsername');

        // Pass admin data to the profile view
        return view('pages.profile', ['username' => $adminUsername]);
    }

    public function newReport()
    {
        // Get the search query from the request
        //$search = $request->input('search');

        // Fetch all reports, applying the search filter if provided
        $reports = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')
            // ->when($search, function ($query, $search) {
            //     return $query->where('User.username', 'like', "%{$search}%")
            //                 ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
            //                 ->orWhere('Issues.issue_type', 'like', "%{$search}%")
            //                 ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
            //                 ->orWhere('Reported_Issue.report_id', 'like', "%{$search}%")
            //                 ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%")
            //                 ->orWhere('Issues.severityLevel', 'like', "%{$search}%");

            //})
            ->get();

        // Pass the $reports variable to the view
        return view('pages.newreport', compact('reports'));
    }
//***************************************************************************************8 */

    public function showpriorityReports()
    {
         // Fetch all reports, applying the search filter if provided
         $reports = DB::table('Reported_Issue')
         ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
         ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
         ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
         ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')
         // ->when($search, function ($query, $search) {
         //     return $query->where('User.username', 'like', "%{$search}%")
         //                 ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
         //                 ->orWhere('Issues.issue_type', 'like', "%{$search}%")
         //                 ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
         //                 ->orWhere('Reported_Issue.report_id', 'like', "%{$search}%")
         //                 ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%")
         //                 ->orWhere('Issues.severityLevel', 'like', "%{$search}%");

         //})
         ->get();

     // Pass the $reports variable to the view
     return view('pages.priorityreport', compact('reports'));
    }


//*************************************************************************************************** */
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
            ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')
            ->when($search, function ($query, $search) {
                return $query->where('User.username', 'like', "%{$search}%")
                            ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                            ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.report_id', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%")
                            ->orWhere('Issues.severityLevel', 'like', "%{$search}%");

            })
            ->get();

        // Pass the $reports variable to the view
        return view('pages.reporthistory', compact('reports'));
    }

//*********************************************************************************************** */
    public function reportdetail($id)
    {
        $report = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->select('Reported_Issue.*',
                     'User.username',
                     'User.contactNumber',
                     'Infrastructure.infrastructure_type',
                     'Issues.issue_type',
                     'Issues.severityLevel')
            ->where('Reported_Issue.report_no', $id)
            ->first();

        // Display the query log to see the exact query being run
        return view('pages.reportdetail', compact('report'));

    }

//****************************************************************************************** */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request to ensure the status is valid
        $request->validate([
            'reportdetail-status' => 'required|in:Pending,In Progress,Resolved',
        ]);

        // Update the status of the report in the database
        DB::table('Reported_Issue')
            ->where('report_no', $id)
            ->update([
                'reportStatus' => $request->input('reportdetail-status'),
            ]);

        // Retrieve the updated report
        $report = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->select('Reported_Issue.*',
                    'User.username',
                    'User.contactNumber',
                    'Infrastructure.infrastructure_type',
                    'Issues.issue_type',
                    'Issues.severityLevel')
            ->where('Reported_Issue.report_no', $id)
            ->first();

        // Redirect back to the report detail page with the updated report and a success message
        return redirect()->back()->with([
            'success' => 'Report status updated successfully.',
            'report' => $report // Send the updated report back to the view
        ]);
    }

//************************************************************************************************ */
    public function logout()
        {
            session()->forget(['adminUsername', 'adminID']);
            return redirect()->route('page.login');
        }

    }
