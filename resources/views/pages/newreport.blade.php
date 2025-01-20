@extends('layouts.headersidebar')

@section('title','New Reports')
@section('content')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
	<div class="w-full">
    <x-search :url="'newreport'"/>
		<div class="relative flex flex-col h-auto p-1 w-full rounded-md">
			<div class="relative rounded-md overflow-y-auto max-h-[calc(100vh-180px)] shadow-xl border border-gray-200">
					<table class="w-full text-sm text-left rtl:text-right text-gray-500 max-h-1/2 shadow-xl">
						<thead class="text-xs text-gray-700 uppercase bg-transparent">
								<tr class="sticky top-0 bg-gray-50">
										<th scope="col" class="px-6 py-3 text-nowrap">no. #</th>
										<th scope="col" class="px-6 py-3">Username</th>
										<th scope="col" class="px-6 py-3">Time</th>
										<th scope="col" class="px-6 py-3">Date</th>
										<th scope="col" class="px-6 py-3 text-nowrap">Infrastructure: Issue</th>
										<th scope="col" class="px-6 py-3">Location</th>
										<th scope="col" class="px-6 py-3 text-nowrap">Priority Level</th>
										<th scope="col" class="px-6 py-3 text-nowrap">Severity Level</th>
										<th scope="col" class="px-6 py-3">Status</th>
										<th scope="col" class="px-6 py-3">Map</th>
										<th scope="col" class="px-6 py-3">
												<span class="sr-only">details</span>
										</th>
								</tr>
						</thead>
						<tbody class="">
								@for ($count = 0; $count < $reports->count(); $count++)
								<tr class="bg-white border-b">
										<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
											{{ $count + 1 }}
										</th>
										<td class="px-6 py-4">
											{{ $reports[$count]->username }}
										</td>
										<td class="px-6 py-4">
											{{ \Carbon\Carbon::parse($reports[$count]->reportDateTime)->format('h : i A') }}
										</td>
										<td class="px-6 py-4">
											{{ \Carbon\Carbon::parse($reports[$count]->reportDateTime)->format('M d, Y') }}
										</td>
										<td class="px-6 py-4">
											{{ $reports[$count]->infrastructure_type }}:
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
													{{ $reports[$count]->issue_type ?? $reports[$count]->other_infrastructure }}
											</span>
										</td>
										<td class="px-6 py-4">
											{{ $reports[$count]->street . ', ' . $reports[$count]->barangay }}
										</td>
										<td class="px-6 py-4">
											{{ $reports[$count]->priorityLevel }}
										</td>
										<td class="px-6 py-4">
											{{ $reports[$count]->severityLevel }}
										</td>
										<td class="px-6 py-4 text-xs text-nowrap">
											<span class="w-full rounded-md px-1.5 py-1 {{$reports[$count]->reportStatus === "In Progress" ? "bg-blue-400/15 text-blue-500" : "bg-orange-400/15 text-orange-500"}}">{{ $reports[$count]->reportStatus }}</span>
										</td>
										<td class="px-6 py-4">
											<a href="/map-view/{{$reports[$count]->report_no }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
													{{ $reports[$count]->longitude === null || $reports[$count]->latitude === null ? '' : 'open map' }}
											</a>
									</td>

										<td>
											<button type="button" data-modal-target="detail-modal-{{ $reports[$count]->report_no }}" data-modal-toggle="detail-modal-{{ $reports[$count]->report_no }}" class="btn-table">View</button>
										</td>
								</tr>
								<!-- Detail Modal -->
								<div id="detail-modal-{{ $reports[$count]->report_no }}" tabindex="-1" class="fixed top-0 bg-none left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full backdrop-blur-sm">
									<div class="relative w-full max-w-fit max-h-full">
										<x-admin-modal-for-clients-details
										:data="(object) [
											'reportNo' => $reports[$count]->report_no,
											'fullname' => $reports[$count]->fullname,
											'address' => $reports[$count]->address,
											'street' => $reports[$count]->street,
											'barangay' => $reports[$count]->barangay,
											'img_url' => $url . $reports[$count]->reportPhoto,
											'date' => \Carbon\Carbon::parse($reports[$count]->created_at)->format('F d, Y'),
											'time' => \Carbon\Carbon::parse($reports[$count]->created_at)->format('h:i a'),
											'cellNumber' => $reports[$count]->contactNumber,
											'infrastructureType' => $reports[$count]->infrastructure_type,
											'issueType' => $reports[$count]->issue_type ?? $reports[$count]->other_infrastructure,
											'reportDesc' => $reports[$count]->description,
											'reportLocation' => $reports[$count]->street . ' ' . $reports[$count]->barangay,
											'severityLevel' => $reports[$count]->severityLevel,
											'priorityLevel' => $reports[$count]->priorityLevel,
											'reportStatus' => $reports[$count]->reportStatus,
											'lat' => $reports[$count]->latitude,
											'long' => $reports[$count]->longitude,
											'updateAt' => \Carbon\Carbon::parse($reports[$count]->status_updated_at)->format('F d, Y') . ' at ' . \Carbon\Carbon::parse($reports[$count]->status_updated_at)->format('h:i a'),
										]"/>
									</div>
								</div>
								<!-- End Details Modal -->
								@endfor
						</tbody>
					</table>
			</div>
		</div>
	</div>
	<script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
@endsection
