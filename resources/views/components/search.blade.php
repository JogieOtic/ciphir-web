<div class="{{Route::is('residents') ? 'h-12 flex' : 'h-24' }} w-full bg-slate-00 flex flex-row px-8">
  @if(!(Route::is('residents')))
  <div class="w-full grid content-center md:flex-wrap">
    <form method="GET" action="{{ route($url) }}" class="flex items-center">
      <div class="relative">
          <input
              id="datepicker-range-start"
              name="start"
              type="date"
              value="{{ request('start') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5"
              placeholder="Select date start"
          />
      </div>
      <span class="mx-4 text-gray-500">to</span>
      <div class="relative">
          <input
              id="datepicker-range-end"
              name="end"
              type="date"
              value="{{ request('end') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1.5"
              placeholder="Select date end"
          />
      </div>
      <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-1 rounded-lg">Filter</button>
      <a href="{{ route($url) }}" class="ml-4 bg-blue-800 hover:bg-slate-700 text-white px-4 py-1 rounded-lg">Reset</a>
    </form>
  </div>
  @endif
  <div class="{{Route::is('residents') ? 'flex flex-row py-2 gap-2 w-full content-center justify-end' : 'w-full grid content-center justify-end'}}">
    <form method="GET" action="{{ route($url) }}">
      <input
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="{{$placeholder ?? 'Name, Infrastructures, Issue....'}}"
          class="border rounded px-2 py-1 w-72"
      />
      <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Search</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
