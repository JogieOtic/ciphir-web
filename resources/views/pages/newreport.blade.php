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
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->reportLocation }}</td>
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
						<div id="detail-modal-{{ $reports[$count]->report_no }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full backdrop-blur-sm">
								<div class="relative w-full max-w-fit max-h-full">
										<!-- Modal content -->
										<div class="relative bg-white rounded-lg shadow w-fit">
												<!-- Modal header -->
												<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
														<h3 class="text-xl font-medium text-gray-900 tracking-wider">
																Report #: {{$reports[$count]->report_no }}
														</h3>
														<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="detail-modal-{{ $reports[$count]->report_no }}">
																<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
																		<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
																</svg>
																<span class="sr-only">Close modal</span>
														</button>
												</div>
												<!-- Modal body -->
												<div class="p-4 md:p-5 space-y-4">
														<div class="w-full">
															<div class="p-4 flex justify-start gap-4">
																<div class="w-96 h-96" style="
																background-image: url('{{ $url ?? '#f0f0f0' }}/{{ $reports[$count]->reportPhoto ?? 'default-photo.jpg' }}');background-position: center;
																background-repeat: no-repeat;
																background-size: contain;
																position: relative;">
																</div>
																
																<div class="flex flex-col text-slate-700">
																	<div class="flex gap-12 justify-start">
																		<div class="flex flex-col">
																			Date:
																			<span class="font-semibold pl-3 text-2xl">
																				{{ \Carbon\Carbon::parse($reports[$count]->created_at)->format('F d, Y') }}
																			</span>
																		</div>
																		<div class="flex flex-col">
																			Time: 
																			<span class="font-semibold pl-3 text-2xl">
																				{{ \Carbon\Carbon::parse($reports[$count]->created_at)->format('h:i a') }}
																			</span>
																		</div>
																	</div>
																	<div class="resident-info text-layout my-4">
																		<ul class="w-52 text-right border-r pr-2 py-2 border-dashed border-slate-500">
																			<li>Fullname</li>
																			<li>Phone Number</li>
																			<li>Address</li>
																		</ul>
																		<ul class="w-full py-2 font-semibold">
																			<li>{{ $reports[$count]->fullname }}</li>
																			<li>{{ $reports[$count]->contactNumber }}</li>
																			<li class="truncate w-60">{{ $reports[$count]->address }}</li>
																		</ul>
																	</div>
																	<div class="flex flex-col pl-3 gap-3 text-slate-700 py-2">
																		<div class="flex gap-2">
																			Infrastructure Type:
																			<span class="font-semibold">
																				{{ $reports[$count]->infrastructure_type}}
																			</span>
																		</div>
																		<div class="flex gap-2">
																			Issue Type:
																			<span class="font-semibold">
																				{{ $reports[$count]->issue_type}}
																			</span>
																		</div>
																		<div class="flex gap-2">
																			Description:
																			<span class="font-semibold">
																				{{ $reports[$count]->description}}
																			</span>
																		</div>
																		<div class="flex gap-2">
																			Report Location:
																			<span class="font-semibold">
																				<a href="/map-view/{{$reports[$count]->report_no }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
																					{{ $reports[$count]->longitude === null || $reports[$count]->latitude === null ? '' : 'open map' }}
																				</a>
																			</span>
																		</div>
																		<div class="flex gap-2">
																			Document:
																			<span class="font-semibold">
																				<a href="{{ $url ?? '#f0f0f0' }}/{{ $reports[$count]->reportPhoto ?? 'default-photo.jpg' }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
																					view larger image
																				</a>
																			</span>
																		</div>
																		<div class="flex gap-2">
																			Last update:
																			<span class="font-semibold">
																				{{ \Carbon\Carbon::parse($reports[$count]->status_updated_at)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($reports[$count]->status_updated_at)->format('h:i a') }}
																				</a>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
												</div>
												<!-- Modal footer -->
												<div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
													<form action="{{ route('updateReportStatus')}}" method="POST"  class="max-w-sm mx-auto">
														@csrf
														@method('PATCH')
														<!-- Hidden Input for Report Number -->
    												<input type="hidden" name="report_no" value="{{ $reports[$count]->report_no }}">
														<div class="w-full flex flex-row justify-between">
															<div class="flex flex-row items-center gap-3">
																<label for="">Status: </label>
																<select 
																	id="reportStatus"
																	name="reportStatus" 
																	class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 p-2.5">
																	<option value="Pending" {{ $reports[$count]->reportStatus === 'Pending' ? 'selected' : '' }}>Pending</option>
																	<option value="In Progress" {{ $reports[$count]->reportStatus === 'In Progress' ? 'selected' : '' }}>In Progress</option>
																	<option value="Resolved" {{ $reports[$count]->reportStatus === 'Resolved' ? 'selected' : '' }}>Resolved</option>
																</select>
															</div>
															<div class="flex flex-row items-center gap-3">
																<label for="">Priority Level: </label>
																<select 
																	id="priorityLevel" 
																	name="priorityLevel" 
																	class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 p-2.5">
																	<option value="Low" {{ $reports[$count]->priorityLevel === 'Low' ? 'selected' : '' }}>Low</option>
																	<option value="Medium" {{ $reports[$count]->priorityLevel === 'Medium' ? 'selected' : '' }}>Medium</option>
																	<option value="High" {{ $reports[$count]->priorityLevel === 'High' ? 'selected' : '' }}>High</option>
																	<option value="Very High" {{ $reports[$count]->priorityLevel === 'Very High' ? 'selected' : '' }}>Very High</option>
																</select>
															</div>
	
															<div>
																<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center text-nowrap">Update Status</button>
															</div>
														</div>
													</form>
  

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

    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
@endsection
