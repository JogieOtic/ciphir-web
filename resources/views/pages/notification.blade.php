<!-- @extends('layouts.headersidebar')

@section('title', 'Notification')


@section('content') -->
<!-- Notification Panel Section -->
<!-- <div id="notificationSidebar" class="notification-sidebar">
                <div class="notification-header">
                    <h2>Notifications</h2>
                    <span class="close-btn" id="closeNotification">&times;</span>
                </div>
                <div class="notification-content"> -->
                    <!-- Clickable Notification for Unprocessed Report
                    @if($notifications->isEmpty())
                    <p>No new notifications</p>
                    @else
                        @foreach($notifications as $notification)
                            <a href="/admin/reports/{{ $notification->data['report_id'] }}" class="notification-link">
                                <div class="notification-item">
                                    <div class="notification-header1">
                                        <span class="title">{{ $notification->data['issue_type'] }}</span>
                                        <span class="status-dot red-dot"></span>  Optionally, adjust the color dynamically -->
                                    <!-- </div>
                                    <div class="notification-body">
                                        <p><strong>Type of Issue:</strong> {{ $notification->data['issue_type'] }}</p>
                                        <p>{{ $notification->data['message'] }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif -->

                    <!-- Clickable Notification for Duplicate Report
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
            </div> -->

<!-- <script src="{{ asset('js/notif.js') }}"></script> -->



<!-- @endsection -->
