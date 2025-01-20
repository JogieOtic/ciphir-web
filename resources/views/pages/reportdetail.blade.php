@extends('layouts.headersidebar')

@section('title', 'Report Details')

@section('content')
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


    <div class="reportdetail-container">
        <div class="reportdetail-header">
            <h1>Report Details</h1>
        </div>
        <div class="reportdetail-content">
            <div class="left-column">
                <div class="section" id="resident-info">
                    <h3>Resident Information</h3>
                    <!-- Dynamically displaying report details from the database -->
                    <p><strong>Report ID:</strong> {{ $report->report_no }}</p>
                    <p><strong>Name:</strong> {{ $report->username }}</p>
                    <p><strong>Contact Number:</strong> {{ $report->contactNumber ?? 'N/A' }}</p>
                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($report->reportDateTime)->format('H:i') }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($report->reportDateTime)->format('m-d-Y') }}</p>
                    <p><strong>Type of Issue:</strong> {{ $report->issue_type }}</p>
                    <p><strong>Severity Level:</strong> {{ $report->severityLevel }}</p>
                </div>
                <div class="reportdetail-section" id="location">
                    <h3>Location</h3>
                    <img src="{{ asset('path/to/location/map/image') }}" alt="Location map">
                </div>
            </div>
            <div class="reportdetail-right-column">
                <div class="reportdetail-section" id="description">
                    <h3>Description</h3>
                    <p>{{ $report->description }}</p>
                </div>
                <div class="reportdetail-section" id="feedback">
                    <h3>Feedback</h3>
                    <div id="stars">
                        {{ $report->feedback ?? 'No feedback available' }}
                    </div>
                </div>
                <div class="reportdetail-section" id="attachments">
                    <h3>Attachments</h3>
                    @if($report->reportPhoto)
                        <img src="https://srv1365-files.hstgr.io/06d57f1cee7090c6/files/public_html/{{ $report->reportPhoto }}" alt="Report Attachment" style="max-width: 100%; height: auto;">
                    @else
                        <p>No attachments available.</p>
                    @endif
                </div>

            </div>
        </div>

        <!-- Back Button -->
        <div class="reportdetail-back-button">
            <button onclick="window.history.back();" class="back-btn">Back</button>
        </div>

        <div class="reportdetail-footer">
            <div>
                <strong>Current Status:</strong> {{ $report->reportStatus }}
            </div>
            <!-- Dropdown for changing the status -->
            <form action="{{ route('page.updateStatus', $report->report_no) }}" method="POST">
                @csrf
                <label for="reportdetail-status">Update Status:</label>
                <select id="status" name="reportdetail-status" required>
                    <option value="">Select Status</option> <!-- Default prompt for the admin -->
                    <option value="Pending" {{ $report->reportStatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $report->reportStatus == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ $report->reportStatus == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>

                <!-- Submit button to update the status -->
                <button type="submit" id="complete-btn">Update Status</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/reportdetail.js') }}"></script>
@endsection
