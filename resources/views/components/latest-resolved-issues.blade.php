
<section class="resolved-issues-container flex flex-col gap-4 font-inter tracking-wider">
  <div class="py-2 px-3 bg-[#DDE8F0] rounded-md shadow-md text-center">
    <span class="text-2xl font-medium mx-auto">Latest Resolved Issues</span>
  </div>
  <div class="flex flex-row py-12 px-3 gap-0 md:gap-4 md:flex-wrap justify-start lg:justify-evenly">
		@for ($count = 0; $count < $latestResolved->count()-1; $count++)
      {{-- card with button --}}
      <div class="transition duration-300 ease-out transform hover:scale-105 flex flex-col w-64 bg-[#ccd7df] place-items-center justify-items-center justify-between py-6 rounded-md shadow-md px-6 gap-5">
        <div class="flex flex-col place-items-center text-center w-full gap-3 border-b border-[#DDE8F0] pb-2 text-slate-800 font-semibold">
          <div class="w-56 h-64" style="
          background-image: url('{{$url}}{{ $latestResolved[$count]->reportPhoto ?? asset('img/default_photo.jpg') }}');
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          position: relative;">
          </div>
          <caption class="text-wrap w-fit mx-auto">{{ $latestResolved[$count]->issue_type }}</caption>
        </div>
        <button data-modal-target="modal-{{ $latestResolved[$count]->report_no }}" data-modal-toggle="modal-{{ $latestResolved[$count]->report_no }}" type="button" class="flex gap-2 flex-nowrap place-items-center hover:bg-blue-700 bg-blue-600 w-4/5 rounded-md py-2 justify-center text-slate-200">
            <span>View details</span>
            <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
      {{-- Details Modal --}}
      <!-- Modal content -->
      <div id="modal-{{ $latestResolved[$count]->report_no }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
        <div class="relative bg-white rounded-lg shadow w-fit">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
              <h3 class="text-xl font-medium text-gray-900 tracking-wider">
                Report #: {{ $latestResolved[$count]->report_no }}
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="modal-{{ $latestResolved[$count]->report_no }}">
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
                      background-image: url('{{$url}}{{ $latestResolved[$count]->reportPhoto ?? 'wow' }}');
                      background-position: center;
                      background-repeat: no-repeat;
                      background-size: contain;
                      position: relative;">
                  </div>
  
  
                  <div class="flex flex-col text-slate-700">
                    <div class="flex gap-12 justify-start">
                      <div class="flex flex-col">
                        Date:
                        <span class="font-semibold pl-3 text-2xl">
                          {{ \Carbon\Carbon::parse($latestResolved[$count]->created_at)->format('F d, Y') }}
                        </span>
                      </div>
                      <div class="flex flex-col">
                        Time: 
                        <span class="font-semibold pl-3 text-2xl">
                          {{ \Carbon\Carbon::parse($latestResolved[$count]->created_at)->format('H:i a') }}
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
                        <li>{{ $latestResolved[$count]->fullname }}</li>
                        <li>{{ $latestResolved[$count]->contactNumber }}</li>
                        <li class="truncate w-60">{{ $latestResolved[$count]->address }}</li>
                      </ul>
                    </div>
                    <div class="flex flex-col pl-3 gap-3 text-slate-700 py-2">
                      <div class="flex gap-2">
                        Infrastructure Type:
                        <span class="font-semibold">
                          {{ $latestResolved[$count]->infrastructure_type }}
                        </span>
                      </div>
                      <div class="flex gap-2">
                        Issue Type:
                        <span class="font-semibold">
                          {{ $latestResolved[$count]->issue_type }}
                        </span>
                      </div>
                      <div class="flex gap-2" title="{{ $latestResolved[$count]->description }}">
                        Description:
                        <span class="font-semibold w-48 truncate">
                          {{ $latestResolved[$count]->description }}
                        </span>
                      </div>
                      <div class="flex gap-2">
                        Report Location:
                        <span class="font-semibold">
                          <a href="/map-view/{{ $latestResolved[$count]->report_no }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
                            {{ $latestResolved[$count]->longitude === null || $latestResolved[$count]->latitude === null ? '' : 'open map' }}
                          </a>
                        </span>
                      </div>
                      <div class="flex gap-2">
                        Document:
                        <span class="font-semibold">
                          <a href="{{$url}}{{ $latestResolved[$count]->reportPhoto ?? 'wow' }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
                            view larger image
                          </a>
                        </span>
                      </div>
                      <div class="flex gap-2">
                        Resolved Date:
                        <span class="font-semibold">
                          {{ \Carbon\Carbon::parse($latestResolved[$count]->created_at)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($latestResolved[$count]->created_at)->format('H:i a') }}
                        </span>
                      </div>
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