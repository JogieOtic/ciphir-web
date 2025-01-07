@extends('layouts.headersidebar')

@section('title','New Reports')
@section('content')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
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
							<td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $reports[$count]->severityLevel }}</td>
							<td class="border border-gray-300 px-4 py-2 text-gray-700 text-center">
								<button type="button" data-modal-target="detail-modal-{{ $reports[$count]->report_no }}" data-modal-toggle="detail-modal-{{ $reports[$count]->report_no }}" class="btn-table">view</button>
							</td>
						</tr>

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
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
@endsection
