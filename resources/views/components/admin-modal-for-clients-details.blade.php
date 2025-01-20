<!-- Modal content -->
<div class="relative bg-white rounded-lg shadow w-fit">
  <!-- Modal header -->
  <div class="flex items-center justify-between pb-2 pt-3 px-4 border-b rounded-t">
      <h3 class="text-xl font-medium text-gray-900 tracking-wider">
          Report #: {{ $data->reportNo }}
      </h3>
      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="detail-modal-{{ $data->reportNo ?? $data->residentID }}">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
      </button>
  </div>
  <!-- Modal body -->
  <div>
      <div class="w-full">
        <div class="p-4 flex justify-start gap-4">
          <div class="w-96 h-96" style="
              background-image: url('{{ $data->img_url ?? 'wow' }}');
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
                  {{ $data->date }}
                </span>
              </div>
              <div class="flex flex-col">
                Time:
                <span class="font-semibold pl-3 text-2xl">
                  {{ $data->time }}
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
                <li>{{ $data->fullname }}</li>
                <li>{{ $data->cellNumber }}</li>
                <li class="truncate w-60" title='{{ $data->address }}'>{{ $data->address }}</li>
              </ul>
            </div>
            <div class="flex flex-col pl-3 gap-3 text-slate-700 py-2">
              <div class="flex gap-2">
                Infrastructure Type:
                <span class="font-semibold">
                  {{ $data->infrastructureType }}
                </span>
              </div>
              <div class="flex gap-2">
                Issue Type:
                <span class="font-semibold">
                  {{ $data->issueType }}
                </span>
              </div>
              <div class="flex gap-2" title="{{ $data->reportDesc }}">
                Description:
                <span class="font-semibold w-48 truncate">
                  {{ $data->reportDesc }}
                </span>
              </div>
              <div class="flex gap-2">
                Coordinates:
                <span class="font-semibold">
                  <a href="/map-view/{{ $data->reportNo }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
                    {{ $data->long === null || $data->lat === null ? '' : 'open map' }}
                  </a>
                </span>
              </div>
              <div class="flex gap-2">
                Street:
                <span class="font-semibold">
                  <span class="truncate w-60 overflow-hidden" title='{{ $data->street }}'>{{ $data->street }}</span>
                </span>
              </div>
              <div class="flex gap-2">
                Barangay:
                <span class="font-semibold">
                  <span class="truncate w-60 overflow-hidden" title='{{ $data->barangay }}'>{{ $data->barangay }}</span>
                </span>
              </div>
              <div class="flex gap-2">
                Document:
                <span class="font-semibold">
                  <a href="{{ $data->img_url ?? 'default-photo.jpg' }}" target="_blank" class="italic hover:bg-slate-300 hover:underline">
                    view larger image
                  </a>
                </span>
              </div>
              <div class="flex gap-2">
                Last update:
                <span class="font-semibold">
                  {{ $data->updateAt }}
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
      <input type="hidden" name="report_no" value="{{ $data->reportNo }}">
      <div class="w-full min-w-fit text-nowrap flex flex-row justify-between">
        <div class="{{$data->reportStatus === 'Resolved' ? 'hidden' : 'flex' }} flex-col items-left gap-1">
          <label for="">Status: </label>
          <select
            id="reportStatus"
            name="reportStatus"
            @if($data->reportStatus === 'Resolved') disabled @endif
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 p-2.5">
            <option value="Pending" {{ $data->reportStatus === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ $data->reportStatus === 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Resolved" {{ $data->reportStatus === 'Resolved' ? 'selected' : '' }}>Resolved</option>
          </select>
        </div>
        <div class="{{$data->reportStatus === 'Resolved' ? 'hidden' : 'flex' }} flex-col items-left gap-1">
          <label for="">Severity Level: </label>
          <select
            id="severityLevel"
            name="severityLevel"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 p-2.5">
            <option value="Low" {{ $data->severityLevel === 'Low' ? 'selected' : '' }}>Low</option>
            <option value="Medium" {{ $data->severityLevel === 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="High" {{ $data->severityLevel === 'High' ? 'selected' : '' }}>High</option>
          </select>
        </div>
        <div class="{{$data->reportStatus === 'Resolved' ? 'hidden' : 'flex' }} flex-col items-left gap-1">
          <label for="">Priority Level: </label>
          <select
            id="priorityLevel"
            name="priorityLevel"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 p-2.5">
            <option value="Low" {{ $data->priorityLevel === 'Low' ? 'selected' : '' }}>Low</option>
            <option value="Medium" {{ $data->priorityLevel === 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="High" {{ $data->priorityLevel === 'High' ? 'selected' : '' }}>High</option>
          </select>
        </div>

        @if(Route::is('reporthistory'))
          <div class="{{$data->reportStatus === 'Resolved' ? 'flex flex-row text-wrap' : 'hidden' }} max-w-[760px] items-left gap-1">
            <label for="" class="font-bold">Feedback: </label>
            <div class="flex flex-col">
              <span>{{ $data->comment }}</span>
              <div class="flex flex-row-reverse text-xs text-slate-700 gap-4">
                <span>{{ \Carbon\Carbon::parse($data->dateSent)->format('h : i A') }}</span>
                <span>{{ \Carbon\Carbon::parse($data->dateSent)->format('M d, Y') }}</span>
              </div>
            </div>
          </div>
        @endif

        <div class="{{$data->reportStatus === 'Resolved' ? 'hidden' : 'flex items-end' }}">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center text-nowrap">Update Status</button>
        </div>
      </div>
    </form>
  </div>
</div>
