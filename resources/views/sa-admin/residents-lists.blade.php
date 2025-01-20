@extends('sa-admin.manage-all-users')
@section('title', 'Manage Residents')
@section('extra-content')
<div class="relative flex flex-col h-auto bg-[#DDE8F0] p-2 w-full rounded-md shadow-md">
    <div class="relative rounded-md overflow-clip">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 max-h-1/2 shadow-xl">
            <div class="pb-2">
                <x-search :url="'residents'" :placeholder="'Username, Fullname, Address, etc...'"/>
            </div>
            {{-- <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">
                <div class="flex flex-row justify-between w-full h-fit">
                    <div class="flex items-center uppercase">
                        Administrators
                    </div>
                    <div class="mt-1 text-base font-normal text-gray-500">
                        <a 
                            href="{{ route('administrators') }}"
                            class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600"
                        >Show All</a>
                    </div>
                </div>				
            </caption> --}}
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                            <th scope="col" class="px-6 py-3">
                                ID #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                    Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                    fullname
                            </th>
                            <th scope="col" class="px-6 py-3">
                                    address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                    contact number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                    report #
                            </th>
                            {{-- deletecolumn --}}
                            {{-- <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">delete</span>
                            </th> --}}
                    </tr>
            </thead>
            <tbody class="capitalize">
                @foreach ($residentInformations as $report)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $report->resident_id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $report->username }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $report->fullname }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $report->address }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $report->contactNumber }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $report->report_count }}
                    </td>
                    {{-- deletebtn --}}
                    {{-- <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection