@extends('sa-admin.index')
@section('title','Manage Users')
@section('content')

<ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
  <li class="me-2">
    <a href="{{ route('issues') }}"
       aria-current="page"
       class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 {{ Route::is('issues') ? 'text-blue-600 bg-gray-150' : '' }}">
      Issues
    </a>
  </li>
  <li class="me-2">
    <a href="{{ route('infrastructures') }}"
       class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 {{ Route::is('infrastructures') ? 'text-blue-600 bg-gray-150' : '' }}">
      Infrastructures
    </a>
  </li>
</ul>
<div class="pt-2">
  @yield('extra-content')
</div>
@endsection
