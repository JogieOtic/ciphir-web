<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $now = Carbon::now();

        // Fetch reports that meet the criteria
        $reportsNotif = DB::table('Reported_Issue')
                ->join('User', 'Reported_Issue.resident_id', '=', 'User.resident_id')
                ->join('Infrastructure', 'Reported_Issue.infrastructure_id', '=', 'Infrastructure.infrastructure_id') // Join Infrastructure table
                ->join('Issues', 'Reported_Issue.issue_id', '=', 'Issues.issue_id') // Use 'Issues' instead of 'Issue'
                ->select(
                    'User.username',
                    'Reported_Issue.report_no',
                    'Reported_Issue.reportStatus',
                    'Reported_Issue.street',
                    'Reported_Issue.barangay',
                    'Reported_Issue.latitude',
                    'Reported_Issue.longitude',
                    'Reported_Issue.status_updated_at',
                    'Reported_Issue.resident_id',
                    'Reported_Issue.reportPhoto',
                    'Reported_Issue.priorityLevel',
                    'Reported_Issue.created_at',
                    'User.fullname',
                    'User.address',
                    'User.contactNumber',
                    'Infrastructure.infrastructure_type', // Ensure this column exists in the Infrastructure table
                    'Issues.issue_type', // Ensure this column exists in the Issues table
                    'Reported_Issue.description',
                    DB::raw('(SELECT COUNT(*) FROM Reported_Issue WHERE reportStatus = "Pending" AND created_at < "' . Carbon::now()->subHours(24) . '") AS unresolved_count')
                )
                ->where('Reported_Issue.reportStatus', 'Pending')
                ->where('Reported_Issue.created_at', '<', Carbon::now()->subHours(24))
                ->get();
        View::share('reportsNotif', $reportsNotif);
        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
        $unresolvedReportNumbers = [];
        // Fetch reports that meet the criteria
        $pendingNum = DB::table('Reported_Issue')->where('reportStatus', 'Pending')->whereIn('priorityLevel',['Low','Medium'])->count();
        $inProgressNum = DB::table('Reported_Issue')->where('reportStatus', 'In Progress')->whereIn('priorityLevel',['Low','Medium'])->count();
        $priorityNum = DB::table('Reported_Issue')->whereIn('reportStatus', ['Pending', 'In Progress'])->where('priorityLevel','High')->count();

        $unresolvedReportNumbers = [
            'pendingNum' => $pendingNum,
            'inProgressNum' => $inProgressNum,
            'priorityNum' => $priorityNum,
        ];
        View::share('unresolvedReportNumbers', $unresolvedReportNumbers);
    }
}
