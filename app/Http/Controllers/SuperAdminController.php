<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function checkAuth(){
        if (Auth::User()->Role === 'A'){
            return redirect('/unauthorized');
        }
        return null;
    }
    public function index(Request $request){
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
            'admins' => DB::table('Admin')->where('Role', 'A')->orderBy('Admin_ID', 'desc')->limit(5)->get(),
            'residents' => DB::table('User')->orderBy('resident_id', 'desc')->limit(5)->get(),
            'issues' => DB::table('Issues')->get(),
            'reported_issues' => DB::table('Reported_Issue')->get(),
            'infrastructures' => DB::table('Infrastructure')->get(),
        ];
        $user = Auth::user();

        return view('sa-admin.dashboard', compact(
            'dataCounts',
            'dataEntity',
            'user',
        ));
    }
    public function updateInfrastructure(Request $request, $id) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $validator = Validator::make($request->all(), [
            'infrastructure_id' => 'required|exists:Infrastructure,infrastructure_id',
            'infrastructure_type' => 'required|string',
            'color_hex' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find the infrastructure in the database
        $infrastructure = DB::table('Infrastructure')->where('infrastructure_id', $id)->first();

        $changes = [];
        // Check if infrastructure_type differs
        if ($infrastructure->infrastructure_type !== $request->infrastructure_type) {
            $changes['infrastructure_type'] = $request->infrastructure_type;
        }

        // Check if color_code differs
        if ($infrastructure->color_code !== $request->color_hex) {
            $changes['color_code'] = $request->color_hex;
        }

        // If no changes are detected, return a message
        if (empty($changes)) {
            return redirect()->back()->with([
                'error' => 'No changes were detected. Update not performed.'
            ], 400);
        }

        // updating
        DB::table('Infrastructure')->where('infrastructure_id', $id)->update($changes);

        return redirect()->back()->with([
            'success' => 'Infrastructure with ID No: '. $id . ' has been updated successfully.',
        ]);
    }
    public function updateIssue(Request $request, $id) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $validator = Validator::make($request->all(), [
            'issue_id' => 'required|exists:Issues,issue_id',
            'infrastructure_id' => 'required|exists:Infrastructure,infrastructure_id',
            'issue' => 'required|string',
            'severity_level' => 'required|string|in:Low,Medium,High',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        // Find the issue in the database
        $issue = DB::table('Issues')->where('issue_id', $id)->first();

        $changes = [];

        // Check if issue_type differs
        if ($issue->issue_type !== $request->issue) {
            $changes['issue_type'] = $request->issue;
        }
        // Check if severityLevel differs
        if ($issue->severityLevel !== $request->severity_level) {
            $changes['severityLevel'] = $request->severity_level;
        }
        // Check if severityLevel differs
        if ($issue->infrastructure_id !== (int)$request->infrastructure_id) {
            $changes['infrastructure_id'] = $request->infrastructure_id;
        }

        // If no changes are detected, return a message
        if (empty($changes)) {
            return redirect()->back()->with([
                'error' => 'No changes were detected. Update not performed.'
            ], 400);
        }
        // updating
        DB::table('Issues')->where('issue_id', $id)->update($changes);
        return redirect()->back()->with([
            'success' => 'Issue with ID No: '. $id . ' has been updated successfully.',
        ]);
    }


    public function addNewIssue(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        // $issue_info = $request->validate([
        //     'infrastructure_id' => 'required|exists:Infrastructure,infrastructure_id',
        //     'issue' => 'required|string',
        //     'severity-level' => 'required|string|in:Low,Medium,High,Very High',
        // ]);
        $validator = Validator::make($request->all(), [
            'infrastructure_id' => 'required|exists:Infrastructure,infrastructure_id',
            'issue' => 'required|string|unique:Issues,issue_type',
            'severity-level' => 'required|string|in:Low,Medium,High,Very High',
        ]);
        if ($validator->fails()){
            $fields = ['infrastructure_id', 'issue', 'severity-level'];
            $message = null;

            foreach ($fields as $field) {
                if ($validator->errors()->first($field)) {
                    $message = $validator->errors()->first($field);
                    break;
                }
            }
            return redirect()->back()->with('error', $message);
        }
        $issue = DB::table('Issues')
            ->insert([
            'infrastructure_id' => $request['infrastructure_id'],
            'issue_type' => $request['issue'],
        ]);
        // return response()->json($newStatus[0]);
        return redirect()->back()->with('success', 'Issue:  '. $request['issue'] . ' has been added successfully.');
    }
    public function addNewInfrastructure(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $validator = Validator::make($request->all(), [
            'infrastructure_type' => 'required|string|unique:Infrastructure,infrastructure_type',
            'color_hex' => 'required|string|unique:Infrastructure,color_code',
        ]);
        if ($validator->fails()){
            $fields = ['infrastructure_type', 'color_hex'];
            $message = null;

            foreach ($fields as $field) {
                if ($validator->errors()->first($field)) {
                    $message = $validator->errors()->first($field);
                    break;
                }
            }
            return redirect()->back()->with('error', $message);
        }
        $infrastructure = DB::table('Infrastructure')
            ->insert([
            'infrastructure_type' => $request['infrastructure_type'],
            'color_code' => $request['color_hex'],
        ]);
        return redirect()->back()->with('success', 'Infrastructure:  '. $request['infrastructure_type'] . ' has been added successfully.');
    }
    public function addNewAdmin(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:Admin,Username',
            'role' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);
        if ($validator->fails()){
            $fields = ['username', 'password'];
            $message = null;

            foreach ($fields as $field) {
                if ($validator->errors()->first($field)) {
                    $message = $validator->errors()->first($field);
                    break;
                }
            }
            return redirect()->back()->with('error', $message);
        }
        $administrator = DB::table('Admin')
                        ->insert([
                            'Username' => $request['username'],
                            'Role' => $request['role'],
                            'Password' => bcrypt($request['password']),
                        ]);
        return redirect()->back()->with('success', 'User:  '. $request['username'] . ' has been added successfully.');
    }
    public function editAdministrator(Request $request, $id) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $admin = DB::table('Admin')->where('Admin_ID', $id)
                    ->where('Admin_ID', $id)
                    ->update(['Username' => $request->username ]);
        return redirect()->back()->with('success', 'User:  '. $request['username'] . ' has been added successfully.');
        // return response()->json($admin);
    }
    public function getAdministrators(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $adminInformations = DB::table('Admin')
                        ->where('Role', 'A')
                        ->orderBy('Admin_ID', 'desc')
                        ->get();
        return view('sa-admin.admin-lists', compact('adminInformations'));
    }
    public function resetPassword(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $defaultPassword = 'nagacityciphir2025';

        $updatedAdminPassword = Admin::where('Admin_ID', $request->admin_id)->first();
        $updatedAdminPassword->Password = bcrypt($defaultPassword); // Hash the new password

        $updatedAdminPassword->save();

        return redirect()->back()->with('success', 'Password reset successfully!');
    }
    public function getResidents(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }

        $search = $request->input('search');

        $residentInformations = DB::table('User')
                        ->leftJoin('Reported_Issue', 'User.resident_id', '=', 'Reported_Issue.resident_id')
                        ->orderBy('resident_id', 'desc') // Order by the number of reports
                        ->select(
                            'User.resident_id',
                            'User.fullname',
                            'User.contactNumber',
                            'User.address',
                            'User.username',  // Add specific fields you need from the User table
                            DB::raw('COUNT(Reported_Issue.report_no) as report_count'), // Count the number of reports
                        )
                        ->groupBy(
                            'User.resident_id',
                            'User.username',
                            'User.fullname',
                            'User.contactNumber',
                            'User.address',) // Group by the fields you're selecting

                        ->when($search, function ($query, $search) {
                            return $query->where(function ($q) use ($search) {
                                $q->where('User.username', 'like', "%{$search}%")
                                ->orWhere('User.resident_id', 'like', "%{$search}%")
                                ->orWhere('User.fullname', 'like', "%{$search}%")
                                ->orWhere('User.contactNumber', 'like', "%{$search}%")
                                ->orWhere('User.address', 'like', "%{$search}%");
                            });
                        })
                        ->get();

        // return response()->json($residentInformations);
        return view('sa-admin.residents-lists', compact('residentInformations'));
    }

    public function saProfile(){
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $sAdminInfo = Auth::User();
        // return response()->json($sAdminInfo);
        return view('sa-admin.profile', compact('sAdminInfo'));
    }
    public function changeUsername(Request $r){
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $validator = Validator::make($r->all(), [
            'oldUsername' => 'required|string',
            'newUsername' => 'required|string|unique:Admin,Username', // Ensure new username is unique
            'password' => 'required|string',
        ]);
        if ($validator->fails()){
            $fields = ['oldUsername', 'newUsername', 'password'];
            $message = null;

            foreach ($fields as $field) {
                if ($validator->errors()->first($field)) {
                    $message = $validator->errors()->first($field);
                    break;
                }
            }
            return redirect()->back()->with('error', $message);
        }
        $sAdmin = DB::table('Admin')->where('Username', $r['oldUsername'])->first();
        // Check if the old username exists and the password is correct
        if (!$sAdmin || !Hash::check($r['password'], $sAdmin->Password)) {
            return redirect()->back()->with(['error' => 'Invalid old username or password.']);
        }
        // return response()->json($r);
        // Update the username
        DB::table('Admin')
            ->where('Username', $r['oldUsername']) // Replace $id with the Admin ID
            ->update(['Username' => $r['newUsername']]); // Use update() to modify the record

        return redirect()->back()->with('success', 'Username with ID No: '. $sAdmin->Admin_ID . ' has been updated successfully.');
    }
    public function changePassword(Request $r){
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $validator = Validator::make($r->all(), [
            'Username' => 'required|string',
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|confirmed',
        ]);
        // Retrieve the admin record based on the username
        if ($validator->fails()) {
            $fields = ['newPassword', 'oldPassword'];
            $message = null;

            foreach ($fields as $field) {
                if ($validator->errors()->first($field)) {
                    $message = $validator->errors()->first($field);
                    break;
                }
            }
            return redirect()->back()->with('error', $message);
        }
        $sAdmin = Admin::where('Username', $r['Username'])->first();

        // Check if the old username exists and the password is correct
        if (!$sAdmin || !Hash::check($r['password'], $sAdmin->Password)) {
            return redirect()->back()->with(['error' => 'Invalid old username or password.']);
        }

        // Update the username
        DB::table('Admin')
            ->where('Username', $r['Username']) // Replace $id with the Admin ID
            ->update(['Password' => $r['newPassword']]); // Use update() to modify the record

        return redirect()->back()->with('success', 'Username with ID No: '. $sAdmin->Admin_ID . ' has been updated successfully.');
    }

    public function getIssues(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $issueInformations = DB::table('Issues')
                            ->join('Infrastructure', 'Issues.infrastructure_id', '=', 'Infrastructure.infrastructure_id')
                            ->select('Issues.*', 'Infrastructure.infrastructure_type')
                            ->orderBy('issue_id', 'asc')
                        ->get();
        $getInfrasrtuctures = DB::table('Infrastructure')->get();
        return view('sa-admin.issue-lists', compact('issueInformations', 'getInfrasrtuctures'));
    }


    public function getInfrastructures(Request $request) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $infrastructureInformations = DB::table('Infrastructure')->get();

        // getting issues to certain infrastructures
        $issues = DB::table('Infrastructure')
                ->join('Issues', 'Infrastructure.infrastructure_id', '=', 'Issues.infrastructure_id') // Ensure correct join
                ->select('Infrastructure.infrastructure_id', 'Infrastructure.infrastructure_type', 'Issues.issue_type') // Adjust columns as needed
                ->get();

        // Process and store the grouped data in a variable
        $groupedData = $issues->groupBy('infrastructure_type')->map(function ($group) {
            return $group->pluck('issue_type')->toArray(); // Get issue types as an array
        });

        // Store as a plain PHP array (if needed)
        $processedData = $groupedData->toArray();

        // return response()->json($processedData);
        return view('sa-admin.infrastructure-lists', compact('infrastructureInformations', 'processedData'));
    }
    public function delete($id) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $user = DB::table('Admin')->where('Admin_ID', $id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Failed to delete the user. ' . $e->getMessage());
        }
        $userContainer = $user->Username;
        // Continue with deletion or other logic
        DB::table('Admin')->where('Admin_ID', $id)->delete();
        return redirect()->back()->with('success', 'User:  '. $userContainer . ' has been deleted successfully.');
    }
    public function deleteIssue($id) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        $issue = DB::table('Issues')->where('issue_id', $id)->first();
        if (!$issue) {
            return redirect()->back()->with('error', 'Failed to delete the issue. ');
        }
        $issueContainer = $issue->issue_type;
        // Continue with deletion or other logic
        DB::table('Issues')->where('issue_id', $id)->delete();
        return redirect()->back()->with('success', 'Issue:  '. $issueContainer . ' has been deleted successfully.');
    }
    public function deleteInfrastructure($id) {
        $redirect = $this->checkAuth();
        if ($redirect) {
            return $redirect; // Return the redirect if checkAuth triggers it
        }
        if($id){
            $deletedInfrastructure = DB::table('Infrastructure')->where('infrastructure_id', $id)->value('infrastructure_type');
            DB::table('Issues')->where('infrastructure_id', $id)->delete();
            DB::table('Infrastructure')->where('infrastructure_id', $id)->delete();
            return redirect()->back()->with('success', 'Infrastructure:  '. $deletedInfrastructure . ' has been deleted successfully.');
        }
        return redirect()->back()->with('error', 'Failed to delete the infrastructure. ');

    }

}
