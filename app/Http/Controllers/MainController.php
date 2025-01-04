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
    public function main(){
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
//******************************************************************************* */
    public function updateProfile(Request $request){
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
//********************************************************************************************8 */
    public function profile()
    {
        // Get admin information from session
        $adminUsername = session('adminUsername');

        // Pass admin data to the profile view
        return view('pages.profile', ['username' => $adminUsername]);
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
}