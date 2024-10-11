<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="/css/dashboardpage.css" rel="stylesheet">
    <link href="/css/notificationpage.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="/img/Web System logo.png" alt="CIPHIR Logo">
                <p>Empowering Communities<br>Through Connection and Collaboration</p>
            </div>
            <div class="notification">
            <a href="/notification" id="notification">
                    <i class="fas fa-bell"></i>
                </a>
            </div>
            <div class="user">
                <a href="#profileModal" id="profileButton">
                    <i class="fas fa-user-circle"></i>
                </a>
            </div>
        </div>
    </header>

    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>

    <main>
        <div class="container-sidebar">
            <div class="sidebar">
                <h2>Dashboard</h2>
                <nav>
                    <ul>
                        <li><a href="/dashboard" class="active" id="homelink">
                            <i class="fas fa-home"></i> Home
                        </a></li>
                        <li><a href="/newreport" id="newreportlink">
                            <i class="fas fa-file-alt"></i> New Reports
                        </a></li>
                        <li><a href="/priorityreport" id="priorityreport">
                            <i class="fas fa-exclamation-circle"></i> Priority Report
                        </a></li>
                        <li><a href="/reporthistory" id="reporthistory">
                            <i class="fas fa-history"></i> Report History
                        </a></li>
                    </ul>
                </nav>
            </div>

             <!-- Notification Panel Section -->
            <div id="notificationSidebar" class="notification-sidebar">
                <div class="notification-header">
                    <h2>Notifications</h2>
                    <span class="close-btn" id="closeNotification">&times;</span>
                </div>
                <div class="notification-content">
                    <!-- Clickable Notification for Unprocessed Report -->
                    @if($notifications->isEmpty())
                    <p>No new notifications</p>
                    @else
                        @foreach($notifications as $notification)
                            <a href="/admin/reports/{{ $notification->data['report_id'] }}" class="notification-link">
                                <div class="notification-item">
                                    <div class="notification-header1">
                                        <span class="title">{{ $notification->data['issue_type'] }}</span>
                                        <span class="status-dot red-dot"></span> <!-- Optionally, adjust the color dynamically -->
                                    </div>
                                    <div class="notification-body">
                                        <p><strong>Type of Issue:</strong> {{ $notification->data['issue_type'] }}</p>
                                        <p>{{ $notification->data['message'] }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    <!-- Clickable Notification for Duplicate Report -->
                    <a href="/duplicate-report-details" class="notification-link">
                        <div class="notification-item duplicate-report">
                            <div class="notification-header1">
                                <span class="title">Duplicate Report</span>
                                <span class="status-dot yellow-dot"></span>
                            </div>
                            <div class="notification-body">
                                <p><strong>Type of Issue:</strong> Roads</p>
                                <p>This report appears to be a duplicate. Please verify and merge or dismiss it.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


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
                <span class="close">&times;</span> <!-- Add the close button -->
                <h3>Profile Information</h3>
                <!-- Profile Input Fields -->
                <div class="input-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" value="ciphir_admin" readonly>
                            <span class="edit-icon"><i class="fas fa-edit"></i></span>
                        </div>

                        <div class="input-group">
                            <label for="oldPassword">Old Password</label>
                            <input type="password" id="oldPassword" value="********" readonly>
                            <span class="edit-icon"><i class="fas fa-edit"></i></span>
                        </div>

                        <div class="input-group" style="display:none;" id="newPasswordFields"> <!-- Hidden initially -->
                            <label for="newPassword">New Password</label>
                            <input type="password" id="newPassword" placeholder="Enter New Password">
                        </div>

                        <div class="input-group" style="display:none;" id="confirmPasswordFields"> <!-- Hidden initially -->
                            <label for="confirmPassword">Confirm New Password</label>
                            <input type="password" id="confirmPassword" placeholder="Confirm New Password">
                        </div>

                        <!-- Buttons Hidden Initially -->
                        <div class="button-group" id="buttons" style="display:none;">
                            <button id="saveButton">Save</button>
                            <button id="cancelButton">Cancel</button>
                        </div>
                    </div>
                </div>

            <!-- Insightful Data Section -->
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
                        <h3>Unresolved Reports</h3>
                        <p>7</p>
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>

                <!-- Common Infrastructure Report Chart -->
                <div class="chart-container">
                    <canvas id="infraChart"></canvas>
                </div>
            </section>
        </div>
    </main>

    <script>
            var modal = document.getElementById("profileModal");
            var btn = document.getElementById("profileButton");
            var span = document.getElementsByClassName("close")[0];
            var modalImg = document.getElementById("modalProfilePic");
            var logoutButton = document.getElementById("logoutButton");

            // Open the modal when the user clicks the profile button
            btn.onclick = function(event) {
                event.preventDefault();
                modal.style.display = "block";

                document.body.style.overflow = "hidden";

                // Set the modal image source to match the admin profile picture
                var adminPicSrc = document.getElementById("adminProfilePic").src;
                modalImg.src = adminPicSrc;
            }

            // Close the modal when the user clicks the close (x) button
            span.onclick = function() {
                modal.style.display = "none";

                document.body.style.overflow = "auto";
            }


            // Close the modal when the user clicks outside the modal content
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Redirect to main page when logout button is clicked
            logoutButton.onclick = function() {
                window.location.href = "/";
            }



            // Manage Your Account
            var editModal = document.getElementById("editModal");
            var manageAccountLink = document.getElementById("manageAccount");
            var cancelButton = document.getElementById("cancelButton");
            var content = document.querySelector('.content');

            // Open the edit modal when the manage account link is clicked
            manageAccountLink.onclick = function(event) {
                event.preventDefault();
                modal.style.display = "none"; // Close profile modal
                editModal.style.display = "block"; // Open edit modal
                content.classList.add('blur');
            }

            // Close the edit modal when the close (x) button is clicked
            cancelButton.onclick = function() {
                editModal.style.display = "none";
                content.classList.remove('blur');
            }

            // Close the edit modal when the user clicks outside the modal content
            window.onclick = function(event) {
                if (event.target == editModal) {
                    editModal.style.display = "none";
                    content.classList.remove('blur');
                }
            }

            // Handle the save button click
            document.getElementById("saveButton").onclick = function() {
                var empId = document.getElementById("employeeId").value;
                var email = document.getElementById("email").value;

                // Example: Print to console (replace with your actual save logic)
                console.log("Employee ID:", empId);
                console.log("Email:", email);

                // Close the modal after saving
                editModal.style.display = "none";
                content.classList.remove('blur');
            }
    </script>
    <script>
    document.getElementById("newReportLink").onclick = function(event) {
        event.preventDefault();
        document.getElementById("homeContent").style.display = "none";
        document.getElementById("newReportsContent").style.display = "block";

        // Update active link styling
        document.getElementById("homeLink").classList.remove("active");
        this.classList.add("active");
    };

    document.getElementById("homeLink").onclick = function(event) {
        event.preventDefault();
        document.getElementById("newReportsContent").style.display = "none";
        document.getElementById("homeContent").style.display = "block";

        // Update active link styling
        document.getElementById("newReportLink").classList.remove("active");
        this.classList.add("active");
    };
    </script>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationIcon = document.getElementById('notification');
            const notificationSidebar = document.getElementById('notificationSidebar');
            const closeNotification = document.getElementById('closeNotification');

            // Hide the notification panel by default
            notificationSidebar.style.right = '-400px'; // Push it off screen by default

            // Show the notification panel when the bell icon is clicked
            notificationIcon.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default anchor link behavior
                if (notificationSidebar.style.right === '0px') {
                    notificationSidebar.style.right = '-400px'; // Close the sidebar
                } else {
                    notificationSidebar.style.right = '0px'; // Open the sidebar
                }
            });

            // Close the notification panel when the close button is clicked
            closeNotification.addEventListener('click', function () {
                notificationSidebar.style.right = '-400px'; // Push it off screen to hide
            });
        });
    </script>
    <!-- <script src="{{ asset('js/notification.js') }}"></script> -->


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
</body>
</html>
