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
        // $imgsUrl = [];
        // foreach ($photoUris as $uri){
        //     $imgsUrl[] = $url . $uri;
        // }                    
        // Return as JSON for API

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
        ));
    }

    public function showpriorityReports(Request $request)
    {
        $search = $request->input('search');
        // Fetch all reports, applying the search filter if provided
        $reports = DB::table('Reported_Issue')
        ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
        ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
        ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
        ->whereIn('priorityLevel', ['Very High', 'High'])
        // ->whereIn('priorityLevel', ['Medium', 'High'])
        ->whereIn('reportStatus', ['In Progress', 'Pending'])
        ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')
        ->when($search, function ($query, $search) {
            return $query->where('User.username', 'like', "%{$search}%")
                        ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                        ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                        ->orWhere('Reported_Issue.reportStatus', 'like', "%{$search}%")
                        ->orWhere('Issues.severityLevel', 'like', "%{$search}%");

        })
        ->get();
        // return response()->json($reports);
        // Pass the $reports variable to the view
        return view('pages.priorityreport', compact('reports'));
    }



    public function newReport(Request $request)
    {
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
            ->where('reportStatus', ['Pending', 'In Progress'])
            ->when($search, function ($query, $search) {
                return $query->where('User.username', 'like', "%{$search}%")
                            ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                            ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
                            ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                            ->orWhere('Issues.severityLevel', 'like', "%{$search}%");
            })
            ->get();
            return view('pages.newreport', compact('reports'));
        }
        $reports = DB::table('Reported_Issue')
            ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
            ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
            ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
            ->whereIn('priorityLevel', ['Medium', 'High', 'Low'])
            ->orderBy('created_at','desc')
            ->whereIn('reportStatus', ['Pending', 'In Progress'])
            ->select('Reported_Issue.*', 'User.username', 'User.fullname', 'User.contactNumber', 'User.address', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')
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
        // return response()->json($reports);
        // Pass the $reports variable to the view
        return view('pages.newreport', compact('reports','url'));
    }
    
    public function reporthistory(Request $request)
    {
        // Fetch all reports, applying the search filter if provided
        if(!empty($request)){
            // search query
            if($request->input('search')){
                $search = $request->input('search');

                $reports = DB::table('Reported_Issue')
                ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
                ->where('reportStatus', 'Resolved')
                ->when($search, function ($query, $search) {
                    return $query->where('User.username', 'like', "%{$search}%")
                                ->orWhere('Infrastructure.infrastructure_type', 'like', "%{$search}%")
                                ->orWhere('Issues.issue_type', 'like', "%{$search}%")
                                ->orWhere('Reported_Issue.reportLocation', 'like', "%{$search}%")
                                ->orWhere('Reported_Issue.report_no', 'like', "%{$search}%")
                                ->orWhere('Issues.severityLevel', 'like', "%{$search}%");
                })
                ->get();
                return view('pages.reporthistory', compact('reports'));
            }
            // date query
            if($request->input('start') || ($request->input('start') && $endDate = $request->input('end'))) {
                $startDate = $request->input('start'); // Start date
                $endDate = Carbon::parse($request->input('end'))->endOfDay(); // Set the end date to the end of the day

                $reports = DB::table('Reported_Issue')
                    ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                    ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                    ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
                    ->where('reportStatus', 'Resolved')
                    ->whereBetween('Reported_Issue.created_at', [$startDate, $endDate]) // Include up to the end of the end date
                    ->orderBy('created_at', 'desc')
                    ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')    
                    ->get();

                return view('pages.reporthistory', compact('reports'));
            }
            // Default query
                $reportsQuery = DB::table('Reported_Issue')
                ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
                ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')
                ->where('reportStatus', 'Resolved');
                $order = $request->input('order', 'asc'); // Default to 'asc'
                $orderSeverity = $request->input('orderSeverity', 'asc'); // Default to 'asc'

            // Check for sorting by username
            if ($request->has('sort') && $request->input('sort') === 'User.username') {
                $reportsQuery->orderBy('User.username', $order);
            }

            // Check for sorting by severity level
            if ($request->has('sortSeverity') && $request->input('sortSeverity') === 'severityLevel') {
                $reportsQuery->orderByRaw("FIELD(Issues.severityLevel, 'Low', 'Medium', 'High', 'Very High') {$orderSeverity}");
                $reportsQuery->orderBy('User.username', $order);

            }

            // Fetch the results
            $reports = $reportsQuery->get();

            return view('pages.reporthistory', compact('reports'));
        }
        $reports = DB::table('Reported_Issue')
        ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
        ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
        ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id')
        ->where('reportStatus', 'Resolved')
        ->orderBy('created_at', 'desc')
        ->select('Reported_Issue.*', 'User.username', 'Infrastructure.infrastructure_type', 'Issues.issue_type', 'Issues.severityLevel')    
        ->get();
        return view('pages.reporthistory', compact('reports'));
    }

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
    public function updateReportStatus(Request $request){
        // Validate the request
        $validated = $request->validate([
            'report_no' => 'required|exists:Reported_Issue,report_no',
            'reportStatus' => 'required|string|in:Pending,In Progress,Resolved', // Ensure the status is one of the allowed values
            'priorityLevel' => 'required|string|in:Low,Medium,High,Very High'
        ]);
        // Get the current date and time in the Philippines
        $updated_at = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        $oldStatus = DB::table('Reported_Issue')
                        ->where('report_no', $validated['report_no'])
                        ->where('priorityLevel', $validated['priorityLevel'])
                        ->select('reportStatus', 'priorityLevel')
                        ->get();
        // Update the status

        $updateStatus = DB::table('Reported_Issue')
        ->where('report_no', $validated['report_no'])
        ->update(['reportStatus' => $validated['reportStatus'], 'priorityLevel' => $validated['priorityLevel'], 'status_updated_at' => $updated_at]);

        $newStatus = DB::table('Reported_Issue')
                        ->where('report_no', $validated['report_no'])
                        ->where('priorityLevel', $validated['priorityLevel'])
                        ->select('reportStatus', 'priorityLevel')
                        ->get();
        // return response()->json($newStatus[0]);
        $message = 'Report no ' . $validated['report_no'] . ' updated successfully!';
        if ($updateStatus) {
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Failed to update report status.');
        }
    }

    // map rendering base on id of the admin client
    public function location($id){
        $latLong = DB::table('Reported_Issue')
                    ->where('Reported_Issue.report_no', $id)
                    ->select('latitude', 'longitude')
                    ->get();
        return view('pages.map-view', compact('latLong'));
    }
}
