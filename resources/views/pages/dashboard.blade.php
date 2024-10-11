@extends('layouts.headersidebar') <!-- Extending the layout file you created -->

@section('title', 'Dashboard') <!-- Setting the title for this page -->

@section('content')
    <!-- Main Content Section -->
    <section class="admin-info">
        <div class="stats">
            <div class="stat-item registered-users">
                <h3>Registered Users</h3>
                <p>49</p>
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-item reports-today">
                <h3>Reports Submitted Today</h3>
                <p>10</p>
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-item resolved-reports">
                <h3>Resolved Reports</h3>
                <p>4</p>
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-item unresolved-reports">
                <h3>Pending Reports</h3>
                <p>7</p>
                <i class="fas fa-clock"></i>
            </div>
        </div>

        <!-- Common Infrastructure Report Chart -->
        <div class="chart-container">
            <canvas id="infraChart"></canvas>
        </div>
    </section>

    <!-- Latest Resolved Issues Section -->
    <section class="resolved-issues">
        <h2>Latest Resolved Issues</h2>
        <div class="issues-list">
            <div class="issue-card">
                <img src="/img/electric.png" alt="Electric Posts">
                <h3>Waste Management</h3>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="issue-card">
                <img src="/img/electric.png" alt="Electric Posts">
                <h3>Electric Posts</h3>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="issue-card">
                <img src="/img/road.jpg" alt="Road Issue">
                <h3>Road Issue</h3>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="issue-card">
                <img src="/img/waste.jpg" alt="Waste Disposal">
                <h3>Waste Disposal</h3>
                <a href="#" class="view-details">View Details</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('infraChart').getContext('2d');
        var infraChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Roads', 'Railways', 'Public Transit', 'Electric Grids', 'Pipelines', 'Drainage', 'Storm Water Management', 'Waste Management', 'Parks'],
                datasets: [{
                    label: 'Common Infrastructure Type Reported',
                    data: [40, 10, 50, 80, 30, 40, 15, 30, 25],
                    backgroundColor: [
                        '#ff6384',
                        '#36a2eb',
                        '#ffcd56',
                        '#4bc0c0',
                        '#9966ff',
                        '#ff9f40',
                        '#ff6384',
                        '#36a2eb',
                        '#ffcd56'
                    ],
                    borderColor: [
                        '#ff6384',
                        '#36a2eb',
                        '#ffcd56',
                        '#4bc0c0',
                        '#9966ff',
                        '#ff9f40',
                        '#ff6384',
                        '#36a2eb',
                        '#ffcd56'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
