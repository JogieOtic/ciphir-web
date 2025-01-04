@extends('layouts.headersidebar')
@section('title','Report History')
@section('content')
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report History</title>
    <link href="/css/reporthistorypage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
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
            const table = document.getElementById('reportTable');
            const rows = Array.from(table.getElementsByTagName('tbody')[0].getElementsByTagName('tr'));

            // Function to format the time to include AM/PM
            function formatTime(date) {
                let hours = date.getHours();
                const minutes = date.getMinutes();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                const minutesFormatted = minutes < 10 ? '0' + minutes : minutes; // zero-padding minutes
                return hours + ':' + minutesFormatted + ' ' + ampm;
            }

            // Function to parse the date in the table and return a Date object
            function parseDate(dateString, timeString) {
                const [year, month, day] = dateString.split('-');
                const [hour, minute] = timeString.split(':');
                return new Date(year, month - 1, day, hour, minute); // Months are zero-based
            }

            // Sort rows by the report date and time (newest first)
            rows.sort((rowA, rowB) => {
                const dateA = parseDate(rowA.getElementsByTagName('td')[3].textContent, rowA.getElementsByTagName('td')[4].textContent);
                const dateB = parseDate(rowB.getElementsByTagName('td')[3].textContent, rowB.getElementsByTagName('td')[4].textContent);

                return dateB - dateA; // Newest reports first
            });

            // Append the sorted rows back to the table and format time with AM/PM
            const tbody = table.getElementsByTagName('tbody')[0];
            rows.forEach((row, index) => {
                row.getElementsByTagName('td')[0].textContent = (index + 1) + '.'; // Update numbering
                const date = parseDate(row.getElementsByTagName('td')[3].textContent, row.getElementsByTagName('td')[4].textContent);
                row.getElementsByTagName('td')[4].textContent = formatTime(date); // Update the time with AM/PM
                tbody.appendChild(row);
            });

            // Filter functionality based on the search input
            searchInput.addEventListener('keyup', function() {
                const filterValue = searchInput.value.toUpperCase();
                let visibleIndex = 1; // To re-number the visible rows during search

                rows.forEach((row) => {
                    const usernameCell = row.getElementsByTagName('td')[1]; // Username is in column 1
                    const reportIdCell = row.getElementsByTagName('td')[2]; // Report ID is in column 2
                    const issueTypeCell = row.getElementsByTagName('td')[5]; // Issue Type is in column 5
                    const infrastructureTypeCell = row.getElementsByTagName('td')[6]; // Infrastructure Type is in column 6
                    const statusCell = row.getElementsByTagName('td')[7]; // Status is in column 7

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
                            row.style.display = ''; // Show row if match is found
                            row.getElementsByTagName('td')[0].textContent = visibleIndex + '.'; // Update numbering for visible rows
                            visibleIndex++;
                        } else {
                            row.style.display = 'none'; // Hide row if no match
                        }
                    }
                });
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('reportTable');
            const headers = table.querySelectorAll('th[data-column]');
            const tbody = table.querySelector('tbody');

            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.getAttribute('data-column');
                    const order = header.getAttribute('data-order');
                    const rows = Array.from(tbody.querySelectorAll('tr'));

                    // Determine sort order
                    const isAscending = order === 'asc';

                    // Sort rows
                    rows.sort((a, b) => {
                        const aText = a.querySelector(`td:nth-child(${header.cellIndex + 1})`).innerText.trim();
                        const bText = b.querySelector(`td:nth-child(${header.cellIndex + 1})`).innerText.trim();

                        // Handle numeric and string sorting
                        if (!isNaN(aText) && !isNaN(bText)) {
                            return isAscending ? aText - bText : bText - aText;
                        } else {
                            return isAscending
                                ? aText.localeCompare(bText)
                                : bText.localeCompare(aText);
                        }
                    });

                    // Append sorted rows to the tbody
                    rows.forEach(row => tbody.appendChild(row));

                    // Toggle sort order for the next click
                    header.setAttribute('data-order', isAscending ? 'desc' : 'asc');
                });
            });
        });
    </script>


    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
</body>
</html>

@endsection