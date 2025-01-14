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
        // count the data inside database
        $dataCounts = [
            'admin_count' => DB::table('Admin')->where('Role', 'A')->count(),
            'user_count' => DB::table('User')->count(),
            'issue_count' => DB::table('Issues')->count(), // Add the table name for 'Issues'
            'infrastructure_count' => DB::table('Infrastructure')->count(),
            'report_count' => DB::table('Reported_Issue')->count(),
        ];

        $dataEntity = [
            'admins' => DB::table('Admin')->where('Role', 'A')->orderBy('Admin_ID', 'desc')->limit(10)->get(),
            'residents' => DB::table('User')->orderBy('resident_id', 'desc')->limit(10)->get(),
            'issues' => DB::table('Issues')->get(),
            'reported_issues' => DB::table('Reported_Issue')->get(),
            'infrastructures' => DB::table('Infrastructure')->get(),
        ];
        $user = Auth::user();

        return view('sa-admin.index', compact(
            'dataCounts',
            'dataEntity',
            'user',
        ));
    }
    public function updateInfrastructures(Request $request) {
        return response()->json(['msg'=>'Updinfra']);
    }

    public function addNewIssue(Request $request) {
        $issue_info = $request->validate([
            'infrastructure_id' => 'required|exists:Infrastructure,infrastructure_id',
            'issue' => 'required|string',
            'severity-level' => 'required|string|in:Low,Medium,High,Very High',
        ]);
        $issue = DB::table('Issues')
            ->insert([
            'infrastructure_id' => $issue_info['infrastructure_id'],
            'issue_type' => $issue_info['issue'],
            'severityLevel' => $issue_info['severity-level'],
        ]);
        // return response()->json($newStatus[0]);
        $message = 'Added updated successfully!';
        if ($issue) {
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Failed to update report status.');
        }
    }
    public function addNewInfrastructure(Request $request) {
        $infrastructure_info = $request->validate([
            'infrastructure_type' => 'required|string|unique:Infrastructure,infrastructure_type',
            'color_hex' => 'required|string|unique:Infrastructure,color_code',
        ]);

        $infrastructure = DB::table('Infrastructure')
            ->insert([
            'infrastructure_type' => $infrastructure_info['infrastructure_type'],
            'color_code' => $infrastructure_info['color_hex'],
        ]);

        return response()->json($infrastructure);
    }
    public function addNewAdmin(Request $request) {
        $admin_info = $request->validate([
            'username' => 'required|string|unique:Admin,Username',
            'role' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);
        // return response()->json($admin_info);
        $administrator = DB::table('Admin')
            ->insert([
                'Username' => $admin_info['username'],
                'Role' => $admin_info['role'],
                'Password' => bcrypt($admin_info['password']),
            ]);
        return ($administrator === true ? response()->json($administrator) : 'errror');
    }

    public function manageAllUsers(Request $request) {
        return view('sa-admin.manage-all-users');
    }
}
