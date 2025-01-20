@extends('sa-admin.index')
@section('title', 'Dashboard')
@section('content')
<h5 class="text-2xl font-bold py-2 text-[#2D4373]">Recent Registrations</h5>
<p class="text-base font-normal text-[#2D4373] pb-4">Displays the 5 <span class="italic">five</span> most recently registered users.</p>

  <div class="flex flex-row gap-6">
    <x-all-users-info :dataEntity="$dataEntity"/>
    <x-sa-data :dataCounts="$dataCounts" :dataEntity="$dataEntity"/>
  </div>
            

@endsection