@extends('layouts.headersidebar')

@section('title','New Reports')
@section('content')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
	<div class="w-full">
    <x-search :url="'newreport'"/>
		<div class="bg-red-700">
		@if (session('success'))
			<div id="alert-success" class="text-center bg-green-100 text-green-800 border border-green-400 rounded px-4 py-2">
				{{ session('success') }}
			</div>
		@endif
		{{-- notify the actions --}}
		@if (session('error'))
			<div id="alert-error" class="text-center bg-red-100 text-red-800 border border-red-400 rounded px-4 py-2">
				{{ session('error') }}
			</div>
		@endif
		</div>

		<script>
				// Remove success alert after 3 seconds
				setTimeout(() => {
						const successAlert = document.getElementById('alert-success');
						if (successAlert) {
								successAlert.remove();
						}
				}, 5000);

				// Remove error alert after 3 seconds
				setTimeout(() => {
						const errorAlert = document.getElementById('alert-error');
						if (errorAlert) {
								errorAlert.remove();
						}
				}, 3000);
		</script>


		<section class="w-full overflow-auto h-[calc(100vh-162px)]">
			<table class="w-full table-auto border-collapse border border-gray-300 bg-blue-100">
				<thead>
					<tr class="bg-blue-500 text-white sticky top-0">
						<th class="table-head">No. #</th>
						<th class="table-head">Username</th>
						<th class="table-head">Time</th>
						<th class="table-head">Date</th>
						<th class="table-head">Infrastructure: Issue</th>
						<th class="table-head">Location</th>
						<th class="table-head">Priority</th>
						<th class="table-head">Status</th>
						<th class="table-head">Map</th>
						<th class="table-head">Details</th>
					</tr>
				</thead>
				<tbody class="overscroll-contain overflow-y-auto h-full">
					@for ($count = 0; $count < $reports->count(); $count++)
						<tr class="hover:bg-blue-200">
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $count + 1 }}</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700 lowercase">{{ $reports[$count]->username }}</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ \Carbon\Carbon::parse($reports[$count]->reportDateTime)->format('h : i A') }}</td>
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
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->street . ', ' . $reports[$count]->barangay }}</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->priorityLevel }}</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->reportStatus }}</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700">
								<a href="/map-view/{{$reports[$count]->report_no }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
									{{ $reports[$count]->longitude === null || $reports[$count]->latitude === null ? '' : 'open map' }}
								</a>
							</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700 text-center">
								<button type="button" data-modal-target="detail-modal-{{ $reports[$count]->report_no }}" data-modal-toggle="detail-modal-{{ $reports[$count]->report_no }}" class="btn-table">view</button>
							</td>
						</tr>

						<!-- Details Modal -->
						<div id="detail-modal-{{ $reports[$count]->report_no }}" tabindex="-1" class="fixed top-0 bg-none left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full backdrop-blur-sm">
								<div class="relative w-full max-w-fit max-h-full">
									<x-admin-modal-for-clients-details 
									:data="(object) [
										'reportNo' => $reports[$count]->report_no,
										'fullname' => $reports[$count]->fullname,
										'address' => $reports[$count]->address, 
										'img_url' => $url . $reports[$count]->reportPhoto, 
										'date' => \Carbon\Carbon::parse($reports[$count]->created_at)->format('F d, Y'),
										'time' => \Carbon\Carbon::parse($reports[$count]->created_at)->format('h:i a'),
										'cellNumber' => $reports[$count]->contactNumber,
										'infrastructureType' => $reports[$count]->infrastructure_type,
										'issueType' => $reports[$count]->issue_type,
										'reportDesc' => $reports[$count]->description,
										'reportLocation' => $reports[$count]->street . ' ' . $reports[$count]->barangay,
										'priorityLevel' => $reports[$count]->priorityLevel,
										'reportStatus' => $reports[$count]->reportStatus,
										'lat' => $reports[$count]->latitude,
										'long' => $reports[$count]->longitude,
										'updateAt' => \Carbon\Carbon::parse($reports[$count]->status_updated_at)->format('F d, Y') . 'at' . \Carbon\Carbon::parse($reports[$count]->status_updated_at)->format('h:i a'),
									]"/>
								</div>
						</div>
						<!-- End Details Modal -->

					@endfor
				</tbody>
			</table>
		</section>
	</div>

    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
@endsection
