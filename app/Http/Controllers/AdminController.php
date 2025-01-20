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
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public const URL = 'https://darkgoldenrod-goose-321756.hostingersite.com/';
    public function checkAuth(){
        if (Auth::User()->Role === 'SA'){
            return redirect('/unauthorized');
        }
        return null;
    }
    public function index(){
        $url = AdminController::URL;
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
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        // Fetch statistics for the dashboard
        $registeredUsers = DB::table('User')->count();

        $reportsToday = DB::table('Reported_Issue')
                        ->whereDate('created_at', '=', date('Y-m-d'))
                        ->count();
        
        $resolvedReports = DB::table('Reported_Issue')
                            ->where('reportStatus', 'Resolved')
                            // ->whereMonth('created_at', $threeMonthsAgo->month)
                            ->count();

        $unresolvedReports = DB::table('Reported_Issue')
                                ->whereIn('reportStatus', ['Pending', 'In Progress'])
                                ->count();

        // Fetch infrastructure report counts
        $infrastructureReports = DB::table('Reported_Issue')
                                    ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                                    ->select(
                                        'Infrastructure.infrastructure_type as name',
                                        'Infrastructure.color_code',
                                        DB::raw('COUNT(*) as total'))
                                    ->groupBy('Infrastructure.infrastructure_type', 'Infrastructure.color_code')
                                    ->orderBy('total', 'desc')
                                    ->get();
        // $photoUris = DB::table('Reported_Issue')->pluck('reportPhoto');
        // Get the last 5 recent resolved issues ordered by created_at
        $latestResolved = DB::table('Reported_Issue')
                        ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                        ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
                        ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                        ->where('reportStatus', 'Resolved') // Filter only resolved issues
                        ->orderBy('created_at', 'desc') // Order by created_at descending
                        ->limit(5) // Limit to the last 5 records
                        ->select('Reported_Issue.*', 'issue_type', 'severityLevel', 'infrastructure_type', 'color_code', 'username', 'fullname', 'address', 'contactNumber') // Only select <thead></thead> 'reportPhoto' column
                        ->get();
        // return response()->json($latestResolved);
        // $imgsUrl = [];
        // foreach ($photoUris as $uri){
        //     $imgsUrl[] = $url . $uri;
        // }
        // Return as JSON for API
        $barangay = DB::table('Barangay')
                ->select('Barangay.*', DB::raw('(SELECT COUNT(*) FROM Reported_Issue WHERE Reported_Issue.barangay = Barangay.barangay_name) as report_count'))
                ->orderBy('report_count', 'desc') // Order by report_count in ascending order
                ->get();

        // Calculate the total report count
        $totalReportCount = $barangay->sum('report_count');

        // Calculate the percentage for each barangay and add it as a new property
        $barangay = $barangay->map(function ($item) use ($totalReportCount) {
            // Avoid division by zero
            $item->percentage = $totalReportCount > 0 ? ($item->report_count / $totalReportCount) * 100 : 0;
            return $item;
        });
        $user = Auth::User();
        // Pass all required variables to the view
        return view('pages.index', compact(
            'notifications',
            'registeredUsers',
            'reportsToday',
            'resolvedReports',
            'unresolvedReports',
            'infrastructureReports',
            'user',
            'url',
            'latestResolved',
            'barangay',
        ));
    }

    public function showpriorityReports(Request $request)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $url = AdminController::URL;
        $search = $request->input('search');
        // Fetch all reports, applying the search filter if provided
        $reports = DB::table('Reported_Issue')
        ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
        ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
        ->leftJoin('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
        ->where('priorityLevel', 'High')
        // ->whereIn('priorityLevel', ['Medium', 'High'])
        ->whereIn('reportStatus', ['In Progress', 'Pending'])
        ->select('Reported_Issue.*', 'User.username', 'User.fullname','User.address', 'User.contactNumber', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Reported_Issue.severityLevel')
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('User.username', 'like', "%{$search}%")
                ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                ->orWhere('Reported_Issue.street', 'like', "%{$search}%")
                ->orWhere('Reported_Issue.barangay', 'like', "%{$search}%")
                ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                ->orWhere('Reported_Issue.severityLevel', 'like', "%{$search}%");
            })
            ->where('priorityLevel', 'High');
        })
        ->get();
        // return response()->json($reports);
        // Pass the $reports variable to the view
        return view('pages.priorityreport', compact('reports', 'url'));
    }



    public function newReport(Request $request)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        // Get the search query from the request
        //$search = $request->input('search');
        $url = AdminController::URL;
        // Fetch all reports, applying the search filter if provided
        // search query
        if($request->input('search')){
            $search = $request->input('search');

            $reports = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('User.username', 'like', "%{$search}%")
                    ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                    ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                    ->orWhere('Reported_Issue.street', 'like', "%{$search}%")
                    ->orWhere('Reported_Issue.barangay', 'like', "%{$search}%")
                    ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                    ->orWhere('Reported_Issue.severityLevel', 'like', "%{$search}%")
                    ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%")
                    ->orWhere('Reported_Issue.priorityLevel', 'like', "%{$search}%");
                })
                ->whereIn('Reported_Issue.reportStatus', ['Pending', 'In Progress'])
                ->whereIn('Reported_Issue.priorityLevel', ['Low', 'Medium']) ;
            })
            ->get();
            return view('pages.newreport', compact('reports', 'url'));
        }
        $reports = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->leftJoin('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->whereIn('priorityLevel', ['Medium', 'Low'])
            ->orderBy('created_at','desc')
            ->whereIn('reportStatus', ['Pending', 'In Progress'])
            ->select('Reported_Issue.*', 'User.username', 'User.fullname', 'User.contactNumber', 'User.address', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Reported_Issue.severityLevel')
            ->get();
        // return response()->json($reports);
        // Pass the $reports variable to the view
        return view('pages.newreport', compact('reports','url'));
    }

    public function reporthistory(Request $request)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $url = AdminController::URL;
        // Fetch all reports, applying the search filter if provided
        if(!empty($request)){
            // search query
            if($request->input('search')){
                $search = $request->input('search');

                $reports = DB::table('Reported_Issue')
                ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
                ->leftJoin('Feedback', 'Reported_Issue.report_no', '=', 'Feedback.report_id')
                ->where('reportStatus', 'Resolved')
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('User.username', 'like', "%{$search}%")
                        ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                        ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.street', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.barangay', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.severityLevel', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.priorityLevel', 'like', "%{$search}%");
                    })
                    ->where('Reported_Issue.reportStatus', 'Resolved');
                })
                ->get();
                return view('pages.reporthistory', compact('reports', 'url'));
            }
            // date query
            if($request->input('start') || ($request->input('start') && $endDate = $request->input('end'))) {
                $startDate = $request->input('start'); // Start date
                $endDate = Carbon::parse($request->input('end'))->endOfDay(); // Set the end date to the end of the day

                $reports = DB::table('Reported_Issue')
                    ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                    ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                    ->join('Feedback', 'Reported_Issue.report_no', '=', 'Feedback.report_id')
                    ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
                    ->where('reportStatus', 'Resolved')
                    ->whereBetween('Reported_Issue.created_at', [$startDate, $endDate]) // Include up to the end of the end date
                    ->orderBy('created_at', 'desc')
                    ->select('Reported_Issue.*', 'User.username', 'User.fullname', 'User.address', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'User.contactNumber', 'Reported_Issue.severityLevel')
                    ->get();

                return view('pages.reporthistory', compact('reports','url'));
            }
            // Default query
            $reportsQuery = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->leftJoin('Feedback', 'Reported_Issue.report_no', '=', 'Feedback.report_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->select('Reported_Issue.*', 'User.username', 'User.fullname', 'User.address', 'User.contactNumber', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Reported_Issue.severityLevel', 'comment', 'dateSent')
            ->where('reportStatus', 'Resolved');
            $order = $request->input('order', 'asc'); // Default to 'asc'
            $orderSeverity = $request->input('orderSeverity', 'asc'); // Default to 'asc'

            // Check for sorting by username
            if ($request->has('sort') && $request->input('sort') === 'User.username') {
                $reportsQuery->orderBy('User.username', $order);
            }

            // Check for sorting by severity level
            if ($request->has('sortSeverity') && $request->input('sortSeverity') === 'severityLevel') {
                $reportsQuery->orderByRaw("FIELD(Reported_Issue.severityLevel, 'Low', 'Medium', 'High') {$orderSeverity}");
                $reportsQuery->orderBy('User.username', $order);

            }

            // Fetch the results
            $reports = $reportsQuery->get();

            // return response()->json($reports);
            return view('pages.reporthistory', compact('reports', 'url'));
        }
    }

    public function reportdetail($id)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $report = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->select('Reported_Issue.*',
                     'User.username',
                     'User.contactNumber',
                     'Infrastructure.infrastructure_type',
                     'Issues.issue_type',
                     'Reported_Issue.severityLevel')
            ->where('Reported_Issue.report_no', $id)
            ->first();

        // Display the query log to see the exact query being run
        return view('pages.reportdetail', compact('report'));

    }
    public function updateReportStatus(Request $request){
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        // Validate the request
        $validator = Validator::make($request->all(), [
            'report_no' => 'required|exists:Reported_Issue,report_no',
            'reportStatus' => 'required|string|in:Pending,In Progress,Resolved',
            'priorityLevel' => 'required|string|in:Low,Medium,High,',
            'severityLevel' => 'required|string|in:Low,Medium,High,'
        ]);
        if ($validator->fails()){
            $fields = ['infrastructure_id', 'issue', 'severityLevel', 'priorityLevel'];
            $message = null;

            foreach ($fields as $field) {
                if ($validator->errors()->first($field)) {
                    $message = $validator->errors()->first($field);
                    break;
                }
            }
            return redirect()->back()->with('error', $message);
        }

        $reportInfos = DB::table('Reported_Issue')->where('report_no', $request['report_no'])->first();

        $changes = [];

        if ($reportInfos->reportStatus !== $request->reportStatus){
            $changes['reportStatus'] = $request->reportStatus;
        }
        if ($reportInfos->priorityLevel !== $request->priorityLevel){
            $changes['priorityLevel'] = $request->priorityLevel;
        }
        if ($reportInfos->severityLevel !== $request->severityLevel){
            $changes['severityLevel'] = $request->severityLevel;
        }

        $username = DB::table('User')
                ->join('Reported_Issue', 'User.resident_id', '=', 'Reported_Issue.resident_id')
                ->where('User.resident_id', $reportInfos->resident_id)
                ->select('User.username', 'Reported_Issue.*') // Specify the columns you want to retrieve
                ->first();

        // If no changes are detected, return a message
        if (empty($changes)) {

            return redirect()->back()->with([
                'error' => 'No changes were detected. Update for ' . $username->username . ' not performed.'
            ], 400);
        }
        DB::table('Reported_Issue')->where('report_no', $request->report_no)->update($changes);

        return redirect()->back()->with([
            'success' => 'Report with username: ' . $username->username . ' has been updated successfully.',
        ], 400);
        // return response()->json($request);

    }

    // map rendering base on id of the admin client
    public function location($id){
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $latLong = DB::table('Reported_Issue')
                    ->where('Reported_Issue.report_no', $id)
                    ->select('latitude', 'longitude')
                    ->get();
        return view('pages.map-view', compact('latLong'));
    }
    public function profile($id)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $userInfo = DB::table('Admin')
                    ->where('Admin_ID', $id)
                    ->select('Admin.*')
                    ->get();

        // Pass admin data to the profile view
        // return response()->json($userInfo);
        return view('pages.profile', compact('userInfo'));
    }
    public function changeUsername(Request $request)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        // Validate the input
        $validated = $request->validate([
            'oldUsername' => 'required|string',
            'newUsername' => 'required|string|unique:Admin,Username', // Ensure new username is unique
            'password' => 'required|string',
        ]);

        // Retrieve the currently authenticated admin
        $admin = Admin::where('Username', $validated['oldUsername'])->first();

        // Check if the old username exists and the password is correct
        if (!$admin || !Hash::check($validated['password'], $admin->Password)) {
            return redirect()->back()->withErrors(['error' => 'Invalid old username or password.']);
        }

        // Update the username
        $admin->Username = $validated['newUsername'];
        $admin->save();

        return redirect()->back()->with('success', 'Username successfully changed!');
    }
    public function changePassword(Request $request)
    {
        // Call checkAuth and handle the return value
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        // return response()->json($request);

        // Validate the input
        $validated = $request->validate([
            'Username' => 'required|string', // Ensure username is provided
            'oldPassword' => 'required|string', // Ensure old password is provided
            'newPassword' => 'required|string|confirmed', // Ensure new password matches confirmation
        ]);
        // Retrieve the admin record based on the username
        $admin = Admin::where('Username', $validated['Username'])->first();

        // Check if the admin exists and if the old password is correct
        if (!$admin || !Hash::check($validated['oldPassword'], $admin->Password)) {
            return response()->json(['error' => 'Invalid username or password.'], 401);
        }

        // Update the password
        $admin->Password = bcrypt($validated['newPassword']); // Hash the new password
        $admin->save();

        return redirect()->back()->with('success', 'Password successfully changed!');
    }

}
