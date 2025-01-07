@extends('layouts.headersidebar')
@section('title','Priority Reports')
@section('content')
<div class="w-full bg-pink-300">
    <section class="new-reports-container overflow-auto h-[calc(100vh-66px)]">
        <table class="w-full table-auto border-collapse border border-gray-300 bg-blue-100">
            <thead>
                <tr class="bg-blue-500 text-white sticky top-0">
                    <th class="table-head">No. #</th>
                    <th class="table-head">Username</th>
                    <th class="table-head">Time</th>
                    <th class="table-head">Date</th>
                    <th class="table-head">Infrastructure: Issue</th>
                    <th class="table-head">Location</th>
                    <th class="table-head">Severity Level</th>
                    <th class="table-head">Details</th>
                </tr>
            </thead>
            <tbody class="overscroll-contain overflow-y-auto h-full">
                @for ($count = 0; $count < $reports->count(); $count++)
                    {{-- @if ( $reports[$count]->priorityLevel == 'High' ) --}}
                            
                        <tr class="hover:bg-blue-200">
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $count + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700 lowercase">{{ $reports[$count]->username }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($reports[$count]->reportDateTime)->format('H : i A') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($reports[$count]->reportDateTime)->format('M d, Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->infrastructure_type }}: 
                                <span class="
                                    @if(in_array($reports[$count]->severityLevel, ['High', 'Very High'])){
                                        text-red-600
                                    }
                                    @elseif($reports[$count]->severityLevel === 'Medium'){
                                        text-orange-500
                                    }
                                    @elseif(in_array($reports[$count]->severityLevel, ['Low', 'Very Low'])){
                                        text-yellow-500
                                    }
                                    @endif"
                                >
                                        {{ $reports[$count]->issue_type }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->reportLocation }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                {{ $reports[$count]->reportStatus }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700 text-center">
                                <button type="button" data-modal-target="detail-modal-{{ $reports[$count]->report_no }}" data-modal-toggle="detail-modal-{{ $reports[$count]->report_no }}" class="btn-table">view</button>
                            </td>
                        </tr>
                    {{-- @endif --}}
                    <!-- Details Modal -->
                    <div id="detail-modal-{{ $reports[$count]->report_no }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
                        <div class="relative w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-medium text-gray-900 dark:text-white tracking-wider">
                                        {{ $reports[$count]->infrastructure_type }}: <span class="italic">{{ $reports[$count]->issue_type }}</span>
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-modal-{{ $reports[$count]->report_no }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                                    </p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                                    </p>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="detail-modal-{{ $reports[$count]->report_no }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                    <button data-modal-hide="detail-modal-{{ $reports[$count]->report_no }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Details Modal -->

                @endfor
            </tbody>
        </table>
    </section>
</div>
@endsection
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Priority Report</title>
    <link href="/css/priorityreportpage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>


    <!-- Table content -->
        <div class="priorityreport-row">
            <!-- High Severity Reports Table -->
            <div class="priorityreport-container high-severity">
                <h2>High Severity Reports</h2> <!-- Indicator for high severity -->
                <div class="table-container">
                    <table id="highReportTable">
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
                                <th>Severity Level</th>
                                <th>Status</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $index => $report)
                                @if($report->severityLevel === 'High') <!-- Display only high severity reports -->
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $report->username }}</td>
                                    <td>{{ $report->report_no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('H:i') }}</td>
                                    <td>{{ $report->issue_type }}</td>
                                    <td>{{ $report->infrastructure_type }}</td>
                                    <td>{{ $report->reportLocation }}</td>
                                    <td>{{ $report->severityLevel }}</td>
                                    <td>
                                        @if($report->reportStatus === 'Pending')
                                            <span class="status pending">Pending</span>
                                        @elseif($report->reportStatus === 'In Progress')
                                            <span class="status in-progress">In Progress</span>
                                        @elseif($report->reportStatus === 'Resolved')
                                            <span class="status resolved">Resolved</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('page.priorityreport', ['id' => $report->report_no]) }}">View Details</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if($reports->where('severityLevel', 'High')->isEmpty())
                        <p>No high severity reports available at the moment.</p>
                    @endif
                </div>
            </div>

            <!-- Medium Severity Reports Table -->
            <div class="priorityreport-container medium-severity">
                <h2>Medium Severity Reports</h2> <!-- Indicator for medium severity -->
                <div class="table-container">
                    <table id="mediumReportTable">
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
                                <th>Severity Level</th>
                                <th>Status</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $index => $report)
                                @if($report->severityLevel === 'Medium') <!-- Display only medium severity reports -->
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $report->username }}</td>
                                    <td>{{ $report->report_no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('H:i') }}</td>
                                    <td>{{ $report->issue_type }}</td>
                                    <td>{{ $report->infrastructure_type }}</td>
                                    <td>{{ $report->reportLocation }}</td>
                                    <td>{{ $report->severityLevel }}</td>
                                    <td>
                                        @if($report->reportStatus === 'Pending')
                                            <span class="status pending">Pending</span>
                                        @elseif($report->reportStatus === 'In Progress')
                                            <span class="status in-progress">In Progress</span>
                                        @elseif($report->reportStatus === 'Resolved')
                                            <span class="status resolved">Resolved</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('page.priorityreport', ['id' => $report->report_no]) }}">View Details</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if($reports->where('severityLevel', 'Medium')->isEmpty())
                        <p>No medium severity reports available at the moment.</p>
                    @endif
                </div>
            </div> <!-- End of container -->

                <!-- Low Severity Reports Table -->
                <div class="priorityreport-container low-severity">
                    <h2>Low Severity Reports</h2> <!-- Indicator for low severity -->
                    <div class="table-container">
                        <table id="lowReportTable">
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
                                    <th>Severity Level</th>
                                    <th>Status</th>
                                    <th>Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $index => $report)
                                    @if($report->severityLevel === 'Low') <!-- Display only low severity reports -->
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $report->username }}</td>
                                        <td>{{ $report->report_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report->reportDateTime)->format('H:i') }}</td>
                                        <td>{{ $report->issue_type }}</td>
                                        <td>{{ $report->infrastructure_type }}</td>
                                        <td>{{ $report->reportLocation }}</td>
                                        <td>{{ $report->severityLevel }}</td>
                                        <td>
                                            @if($report->reportStatus === 'Pending')
                                                <span class="status pending">Pending</span>
                                            @elseif($report->reportStatus === 'In Progress')
                                                <span class="status in-progress">In Progress</span>
                                            @elseif($report->reportStatus === 'Resolved')
                                                <span class="status resolved">Resolved</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('page.priorityreport', ['id' => $report->report_no]) }}">View Details</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if($reports->where('severityLevel', 'Low')->isEmpty())
                            <p>No low severity reports available at the moment.</p>
                        @endif
                    </div>
                </div>
            </div>

    <div id="profileModal" class="profile-modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                    <div class="profile-details">
                        <h3>Administrator</h3>
                        <a href="#editModal" id="manageAccount">Manage Account</a>
                        <button id="logoutButton">Logout
                    </button>
                </div>
            </div>
        </div>

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

    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
</body>
</html> --}}
