@if (session('success'))
  <div id="alert-success" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center bg-green-100 text-green-800 border border-green-400 rounded px-6 py-4 z-50">
    {{ session('success') }}
  </div>
@endif
{{-- notify the actions --}}
@if (session('error'))
  <div id="alert-error" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center bg-red-100 text-red-800 border border-red-400 rounded px-6 py-4 z-50">
    {{ session('error') }}
  </div>
@endif