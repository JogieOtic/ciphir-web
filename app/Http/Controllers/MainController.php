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
                    'Reported_Issue.severityLevel')
            ->where('Reported_Issue.report_no', $id)
            ->first();

        // Redirect back to the report detail page with the updated report and a success message
        return redirect()->back()->with([
            'success' => 'Report status updated successfully.',
            'report' => $report // Send the updated report back to the view
        ]);
    }
}
