@extends('layouts.headersidebar')

@section('title','Dashboard')

@section('content')
	{{-- stats --}}
	<div class="stats-container">
			<div class="stat-item registered-users">
					<h3 class="stat-label">Registered Users</h3>
					<div class="icon-x-data">
						<p class="stats-n">{{ $registeredUsers }}</p>
						<div class="h-12 flex place-items-center">
						<i class="fas fa-users text-blue-600"></i>
						</div>
					</div>
			</div>
			<div class="stat-item reports-today">
					<h3 class="stat-label">Reports Submitted Today</h3>
					<div class="icon-x-data">
						<p class="stats-n">{{ $reportsToday }}</p>
						<div class="h-12 flex place-items-center">
							<i class="fas fa-file-alt text-yellow-500"></i>
						</div>
					</div>
			</div>
			<div class="stat-item resolved-reports">
					<h3 class="stat-label">Resolved Reports</h3>
					<div class="icon-x-data">
						<p class="stats-n">{{ $resolvedReports }}</p>
						<div class="h-12 flex place-items-center">
							<i class="fas fa-check-circle text-green-600"></i>
						</div>
					</div>
			</div>  
			<div class="stat-item unresolved-reports">
					<h3 class="stat-label">Unresolved Reports</h3>
					<div class="icon-x-data">
						<p class="stats-n">{{ $unresolvedReports }}</p>
						<div class="h-12 flex place-items-center">
							<i class="fas fa-times-circle text-red-600"></i>
						</div>
					</div>
			</div>
	</div>
	{{-- end of stats --}}

	@include('components.infrastructureReportStats', ['IRS' => $infrastructureReports])

	<!-- Latest Resolved Issues -->
	@include('components.latest-resolved-issues', ['latestResolved' => $latestResolved, 'url' => $url])
@endsection

{{-- <p>{{ $user->Username }}</p> --}}

