<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard New Report</title>
    <link href="/css/dashboardpage.css" rel="stylesheet">
    <link href="/css/newreportpage.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="/img/Web System logo.png" alt="CIPHIR Logo">
                <p>Empowering Communities<br>Through Connection and Collaboration</p>
            </div>
            <div class="user">
                <a href="#profileModal" id="profileButton">
                    <img src="img/RENNEE Photo.png" alt="User Profile" id="adminProfilePic">
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container-sidebar">
            <div class="sidebar">
                <h2>Dashboard</h2>
                <nav>
                    <ul>
                        <li><a href="/dashboard" id="homelink">Home</a></li>
                        <li><a href="/newreport" class="active" id="newreportlink">New Reports </a></li>
                        <!-- <li><a href="/newreport">New Reports <span class="badge">10+</span></a></li> -->
                        <li><a href="/priorityreport" id="priorityreport">Priority Report</a></li>
                        <li><a href="/reporthistory" id="reporthistory">Reports History</a></li>
                    </ul>
                </nav>
                <div class="notification">
                    <h3>Notification</h3>
                    <div class="notification-item">
                        <i class="fas fa-bell"></i>
                        <h4>New Reminder!</h4>
                        <p>Type of Issue: Electric Post <br> Posted by Jogie Otic last 2024-07-06 <br> still needs attention!</p>
                    </div>
                    <div class="notification-item">
                        <i class="fas fa-bell"></i>
                        <h4>New Reminder!</h4>
                        <p>Type of Issue: Electric Post <br> Posted by Jogie Otic last 2024-07-06 <br> still needs attention!</p>
                    </div>
                    <button>Show all</button>
                </div>
            </div>

    <div class="container-newreport"> 
        <h2>New Report</h2>
        <table class="report-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Report ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Type</th>
                <th>Status</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- <td><span class="star">⭐</span> -->
                <td>1.</td>
                <td>100006062024</td>
                <td>2024-07-07</td>
                <td>11:32 am</td>
                <td>Electric Post</td>
                <td><span class="status on-process">On Process</span></td>
                <td><button class="view-btn">View Details</button></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>100006062024</td>
                <td>2024-07-03</td>
                <td>8:44 am</td>
                <td>Pothole</td>
                <td><span class="status pending">Pending</span></td>
                <td><button class="view-btn">View Details</button></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>100006062024</td>
                <td>2024-07-03</td>
                <td>1:44 pm</td>
                <td>Pothole</td>
                <td><span class="status complete">Complete</span></td>
                <td><button class="view-btn">View Details</button></td>
            </tr>
        </tbody>
    </table>
</div>

        </div>
    </div>
    </main>

    <div id="profileModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="profile-details">
                <img id="modalProfilePic" alt="Profile Picture">
                <h3>Administrator</h3>
                <p><a href="#editModal" id="manageAccount">Manage your Account</a></p>
                <button id="logoutButton">Logout</button>
            </div>
        </div>
    </div>
    
    <div id="editModal" class="modal">
        <div class="modal-content-edit">
            <h3>Profile Information</h3>
            <label for="employeeId">Employee ID</label>
            <div>
                <!-- <span class="edit-icon">✏️</span> -->
                <input type="text" id="employeeId" placeholder="Enter Employee ID">
            </div>
            <label for="email">Email</label>
            <div>
                <!-- <span class="edit-icon">✏️</span> -->
                <input type="email" id="email" placeholder="Enter Email">
            </div>
            <div class="button-group">
                <button id="saveButton">Save</button>
                <button id="cancelButton">Cancel</button>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>

    <!-- JavaScript for Modal -->
    <script>
            var modal = document.getElementById("profileModal");
            var btn = document.getElementById("profileButton");
            var span = document.getElementsByClassName("close")[0];
            var modalImg = document.getElementById("modalProfilePic");
            var logoutButton = document.getElementById("logoutButton");

            // Open the modal when the user clicks the profile button
            btn.onclick = function(event) {
                event.preventDefault(); // Prevent the default anchor behavior
                modal.style.display = "block";
                
                // Set the modal image source to match the admin profile picture
                var adminPicSrc = document.getElementById("adminProfilePic").src;
                modalImg.src = adminPicSrc;
            }

            // Close the modal when the user clicks the close (x) button
            span.onclick = function() {
                modal.style.display = "none";
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

</body>
</html>