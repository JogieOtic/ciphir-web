@extends('sa-admin.index')
@section('title','Manage Users')
@section('content')

<ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
  <li class="me-2">
    <a href="{{ route('administrators') }}"
       aria-current="page"
       class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-300 {{ Route::is('administrators') ? 'text-blue-600 bg-gray-100 cursor-default' : 'hover:text-gray-600 hover:bg-gray-150' }}">
      Administrators
    </a>
  </li>
  <li class="me-2">
    <a href="{{ route('residents') }}"
       class="inline-block p-4 rounded-t-lg {{ Route::is('residents') ? 'text-blue-600 bg-gray-300' : 'hover:text-gray-600 hover:bg-gray-150' }}">
      Residents
    </a>
  </li>
</ul>

  <div class="pt-2">
    @yield('extra-content')
  </div>
@endsection
