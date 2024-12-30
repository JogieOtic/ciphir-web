@extends('layouts.headersidebar')

@section('title','Dashboard')

@section('content')
	<x-sidebar />
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{ asset('img/Web System logo.png') }}" type="image/png">
    {{-- <link href="/css/dashboardpage.css" rel="stylesheet">
    <link href="/css/notificationpage.css" rel="stylesheet"> --}}
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</head>
<body>
	{{-- <x-header :user="$user" /> --}}
  {{-- <x-sidebar /> --}}

    {{-- <main>
        <div class="container-sidebar">
            <div id="profileModal" class="profile-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="profile-details">
                        <h3>Administrator</h3>
                        <a href="#editModal" id="manageAccount">Manage Account</a>
                        <button id="logoutButton">Logout</button>
                    </div>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="modal-content-edit">
                    <h3>Profile Information</h3>
                    <label for="employeeId">Username</label>
                    <div>
                        <input type="text" id="employeeId" placeholder="Enter Username">
                    </div>
                    <label for="Password">Password</label>
                    <div>
                        <input type="password" id="password" placeholder="Enter Password">
                    </div>
                    <div class="button-group">
                        <button id="saveButton">Save</button>
                        <button id="cancelButton">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


            <div class="stats">
            <div class="stat-item registered-users">
                <h3>Registered Users</h3>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="z-50">Logout</button>
                </form>
                <p>{{ $registeredUsers }}</p>
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-item reports-today">
                <h3>Reports Submitted Today</h3>
                <p>{{ $reportsToday }}</p>
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-item resolved-reports">
                <h3>Resolved Reports</h3>
                <p>{{ $resolvedReports }}</p>
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-item unresolved-reports">
                <h3>Unresolved Reports</h3>
                <p>{{ $unresolvedReports }}</p>
                <i class="fas fa-times-circle"></i>
            </div>
        </div>

        <!-- Infrastructure Report Statistics -->
        <div class="infrastructure-statistics">
            <h3>Infrastructure Report Statistics</h3>
            <div class="statistics-overview">
                <div class="total-issues">
                    <h1>{{ $infrastructureReports->sum('total') }}</h1>
                    <p>Total Reports</p>
                </div>
                <canvas id="infraChart"></canvas>
            </div>
            <ul class="category-list">
                @foreach ($infrastructureReports as $report)
                    <li>
                        <div class="icon {{ strtolower(str_replace(' ', '-', $report->name)) }}"></div>
                        <h4>{{ $report->name }}</h4>
                        <p class="value">{{ $report->total }}</p>
                    </li>
                @endforeach
            </ul>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>

        <script>
            const infrastructureReports = @json($infrastructureReports);

            // Extract labels and data for the chart
            const labels = infrastructureReports.map(report => report.name);
            const data = infrastructureReports.map(report => report.total);

            // Initialize the Doughnut Chart
            const ctx = document.getElementById('infraChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            '#FFDFD3', '#D3E3FF', '#D5F8E1', '#FFF3D3',
                            '#FCE5E6', '#E1F4FE', '#F4E1FF', '#D8F3DC', '#FFD6A5'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    }
                }
            });
        </script>




    <!-- Latest Resolved Issues -->
   <section class="resolved-issues">
            <h2>Latest Resolved Issues</h2>
            <div class="issues-list">
                <div class="issue-card">
                    <img src="/img/electric.png" alt="Electric Posts">
                    <h3>Waste Management</h3>
                    <a href="#" class="learn-more">View  Details</a>

                </div>
                <div class="issue-card">
                    <img src="/img/electric.png" alt="Electric Posts">
                    <h3>Electric Posts</h3>
                    <a href="#" class="learn-more">View Details</a>
                </div>
                <div class="issue-card">
                    <img src="/img/road.jpg" alt="Road Issue">
                    <h3>Road Issue</h3>
                    <a href="#" class="learn-more">View Details</a>
                </div>
                <div class="issue-card">
                    <img src="/img/waste.jpg" alt="Waste Disposal">
                    <h3>Waste Disposal</h3>
                    <a href="#" class="learn-more">View Details</a>
                </div>
                <div class="issue-card">
                    <img src="/img/waste.jpg" alt="Waste Disposal">
                    <h3>Waste Disposal</h3>
                    <a href="#" class="learn-more">View Details</a>
                </div>
            </div>
      </section>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="{{ asset('js/dashboard.js') }}"></script> --}}
</body>
</html>

{{-- <p>{{ $user->Username }}</p> --}}

