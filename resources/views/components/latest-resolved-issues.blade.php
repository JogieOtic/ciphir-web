
<section class="resolved-issues-container flex flex-col gap-4 font-inter tracking-wider">
  <div class="py-2 px-3 bg-[#DDE8F0] rounded-md shadow-md text-center">
    <span class="text-2xl font-medium mx-auto">Latest Resolved Issues</span>
  </div>
  <div class="flex flex-row py-12 px-3 gap-0 md:gap-4 md:flex-wrap justify-start lg:justify-evenly">
		@for ($count = 0; $count < $latestResolved->count(); $count++)
      {{-- card with button --}}
      <div class="transition duration-300 ease-out transform hover:scale-105 flex flex-col w-fit bg-[#ccd7df] place-items-center py-6 rounded-md shadow-md px-6 gap-5">
        <div class="flex flex-col place-items-center w-full gap-3 border-b border-[#DDE8F0] pb-2 text-slate-800 font-semibold">
            <img src="{{$url}}/{{$latestResolved[$count]->reportPhoto}}" alt="" width="200" class="rounded-sm">
            <caption>{{ $latestResolved[$count]->issue_type }}</caption>
        </div>
        <button data-modal-target="modal-{{ $latestResolved[$count]->report_no }}" data-modal-toggle="modal-{{ $latestResolved[$count]->report_no }}" type="button" class="flex gap-2 flex-nowrap place-items-center hover:bg-blue-700 bg-blue-600 w-4/5 rounded-md py-2 justify-center text-slate-200">
            <span>View details</span>
            <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
      {{-- card with button --}}

      
      {{-- Details Modal --}}
      <div id="modal-{{ $latestResolved[$count]->report_no }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-5xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <span class="font-normal">Report Details:</span> <span class="underline">{{ $latestResolved[$count]->issue_type }}</span>
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-{{ $latestResolved[$count]->report_no }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 flex justify-start gap-4">
                  <img src="{{$url}}/{{$latestResolved[$count]->reportPhoto}}" alt="" width="460" class="rounded-lg">
                  <div class="flex flex-col p-2">
                    <div class="resident-info text-layout">
                      <ul class="w-52 text-right border-r pr-2 py-2 border-dashed border-slate-500">
                        <li>Fullname</li>
                        <li>Phone Number</li>
                        <li>Address</li>
                      </ul>
                      <ul class="w-full py-2 font-semibold">
                        <li>{{ $latestResolved[$count]->fullname }}</li>
                        <li>{{ $latestResolved[$count]->contactNumber }}</li>
                        <li class="truncate w-60">{{ $latestResolved[$count]->address }}</li>
                      </ul>
                    </div>
                    <div class="flex flex-col text-slate-200 py-2">
                      <div class="flex gap-4">
                        Time: 
                        <span>
                          {{ \Carbon\Carbon::parse($latestResolved[$count]->created_at)->format('H:i a') }}
                        </span>
                      </div>
                      <div class="flex gap-4">
                        Date:
                        <span>
                          {{ \Carbon\Carbon::parse($latestResolved[$count]->created_at)->format('F d, Y') }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
		@endfor
	</div>
</section>