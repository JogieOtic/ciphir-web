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

    public function submit(Request $request)
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

            return "Form submitted!";
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


    public function priorityreport()
    {
        return view('pages.priorityreport');
    }

    public function reporthistory()
    {
        // For now, just create a sample empty array or dummy data
        $reports = [
            (object)[
                'username' => 'JohnDoe',
                'report_id' => '100001',
                'date' => '2024-07-10',
                'time' => '12:00 pm',
                'issue_type' => 'Exposed Wires',
                'infrastructure_type' => 'Electric Grids',
                'status' => 'On Process'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'bia',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'jogyo',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Roadside',
                'infrastructure_type' => 'Roads',
                'status' => 'Resolved'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Pending'
            ],
            (object)[
                'username' => 'JaneSmith',
                'report_id' => '100002',
                'date' => '2024-07-09',
                'time' => '10:30 am',
                'issue_type' => 'Pothole',
                'infrastructure_type' => 'Roads',
                'status' => 'Resolved'
            ],
        ]; // Dummy data until the database is ready

        // Pass the $reports variable to the view
        return view('pages.reporthistory', compact('reports'));
    }
}
