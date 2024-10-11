<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report History</title>
    <link href="/css/reporthistorypage.css" rel="stylesheet">
    <link href="/css/dashboardpage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
                        <li><a href="/dashboard"  id="homelink">
                            <i class="fas fa-home"></i> Home
                        </a></li>
                        <li><a href="/newreport" id="newreportlink">
                            <i class="fas fa-file-alt"></i> New Reports
                        </a></li>
                        <li><a href="/priorityreport" id="priorityreport">
                            <i class="fas fa-exclamation-circle"></i> Priority Report
                        </a></li>
                        <li><a href="/reporthistory" class="active" id="reporthistory">
                            <i class="fas fa-history"></i> Report History
                        </a></li>
                    </ul>
                </nav>
            </div>

            <!--Profile Modal-->
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

            <!-- Main dashboard content -->
            <div class="dashboard-container">
                <div class="search-container">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search here">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>


                <div class="table-container">
                    <table id="reportTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Report ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Issue Type</th>
                                <th>Infrastructure Type</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $index => $report)
                            <tr>
                                <td>{{ $index + 1 }}.</td>
                                <td>{{ $report->username }}</td>
                                <td>{{ $report->report_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('H:i') }}</td>
                                <td>{{ $report->issue_type }}</td>
                                <td>{{ $report->infrastructure_type }}</td>
                                <td>{{ $report->reportLocation }}</td>
                                <td>
                                    @if($report->reportStatus === 'Pending')
                                        <span class="status pending">Pending</span>
                                    @elseif($report->reportStatus === 'In Progress')
                                        <span class="status in-progress">In Progress</span>
                                    @elseif($report->reportStatus === 'Resolved')
                                        <span class="status resolved">Resolved</span>
                                    @endif
                                </td>
                                <td><button class="view-details-btn">View Details</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(empty($reports))
                        <p>No reports available at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>


    <div id="editModal" class="modal">
    <div class="modal-content-edit">
        <h3>Profile Information</h3>
        <label for="employeeId">Employee ID</label>
        <div>
            <input type="text" id="employeeId" placeholder="Enter Employee ID">
        </div>
        <label for="email">Email</label>
        <div>
            <input type="email" id="email" placeholder="Enter Email">
        </div>
        <div class="button-group">
            <button id="saveButton">Save</button>
            <button id="cancelButton">Cancel</button>
        </div>
    </div>
    </div>



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

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');

                searchInput.addEventListener('keyup', function() {
                    const filterValue = searchInput.value.toUpperCase();
                    const table = document.getElementById('reportTable');
                    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                    for (let i = 0; i < rows.length; i++) {
                        const usernameCell = rows[i].getElementsByTagName('td')[1]; // Username is in column 1
                        const reportIdCell = rows[i].getElementsByTagName('td')[2]; // Report ID is in column 2
                        const issueTypeCell = rows[i].getElementsByTagName('td')[5]; // Issue Type is in column 5
                        const infrastructureTypeCell = rows[i].getElementsByTagName('td')[6]; // Infrastructure Type is in column 6
                        const statusCell = rows[i].getElementsByTagName('td')[7]; // Status is in column 7

                        if (usernameCell || reportIdCell || issueTypeCell || infrastructureTypeCell || statusCell) {
                            const usernameText = usernameCell.textContent || usernameCell.innerText;
                            const reportIdText = reportIdCell.textContent || reportIdCell.innerText;
                            const issueTypeText = issueTypeCell.textContent || issueTypeCell.innerText;
                            const infrastructureTypeText = infrastructureTypeCell.textContent || infrastructureTypeCell.innerText;
                            const statusText = statusCell.textContent || statusCell.innerText;

                            if (
                                usernameText.toUpperCase().indexOf(filterValue) > -1 ||
                                reportIdText.toUpperCase().indexOf(filterValue) > -1 ||
                                issueTypeText.toUpperCase().indexOf(filterValue) > -1 ||
                                infrastructureTypeText.toUpperCase().indexOf(filterValue) > -1 ||
                                statusText.toUpperCase().indexOf(filterValue) > -1
                            ) {
                                rows[i].style.display = ''; // Show row if match is found
                            } else {
                                rows[i].style.display = 'none'; // Hide row if no match
                            }
                        }
                    }
                });
            });
    </script>
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
</body>
</html>
