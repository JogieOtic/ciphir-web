<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



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

        // Find admin by username
        $admin = DB::table('Admin')->where('username', $request->username)->first();

        // Check if admin exists and password matches
        if ($admin && Hash::check($request->password, $admin->Password)) {
            // Login successful, redirect to the dashboard
            return redirect()->route('page.dashboard');
        } else {
            // Invalid credentials, redirect back with error message
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


    public function showPriorityReports() {
        $reports = Report::all();  // Replace this with the actual query you're using
        return view('pages.priorityreport', ['reports' => $reports]);
    }
    

    public function reporthistory()
    {
        // Join Report and Resident tables to get the Username from the Resident table
        $reports = DB::table('Report')
                    ->join('Resident', 'Report.Resident_ID', '=', 'Resident.Resident_ID')
                    ->select('Report.*', 'Resident.Username')
                    ->get();

        // Pass the $reports variable to the view
        return view('pages.reporthistory', compact('reports'));
    }
}
