@extends('sa-admin.manage-report-entities')
@section('title', 'Manage Issues')
@section('extra-content')
<div class="relative flex flex-col h-auto bg-[#DDE8F0] p-1 w-full rounded-md shadow-md">
    <div class="relative rounded-md overflow-y-auto max-h-[calc(100vh-130px)] shadow-xl border border-gray-200">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 max-h-1/2 shadow-xl">
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
                    <tr class="sticky top-0 bg-gray-50">
                        <th scope="col" class="px-6 py-3">
                                ID #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Issues
                        </th>
                        <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Delete</span>
                        </th>
                    </tr>
            </thead>
            <tbody class="">
                @foreach ($issueInformations as $report)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $report->issue_id }}
                    </th>
                    <td class="px-6 py-4">
                            {{ $report->issue_type }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button data-modal-target="edit-{{ $report->issue_id }}" data-modal-toggle="edit-{{ $report->issue_id }}" class="font-medium text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pen-to-square text-lg"></i>
                        </button>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button data-modal-target="popup-{{ $report->issue_id }}" data-modal-toggle="popup-{{ $report->issue_id }}" class="font-medium text-red-600 hover:underline"><i class="fa-solid fa-trash-can text-lg"></i></button>
                    </td>
                </tr>
                {{-- Delete Modal --}}
                <div id="popup-{{ $report->issue_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-fit max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-{{ $report->issue_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-5 text-center">
                                <svg class="mx-auto mb-4 text-red-600 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this Issue: <span class="text-blue-600 italic font-bold tracking-wider">{{$report->issue_type}}</span>?</h3>
                                <form action="{{ route('sa.deleteIssue', $report->issue_id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-modal-hide="popup-{{ $report->issue_id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                </form>
                                <button data-modal-hide="popup-{{ $report->issue_id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Username modal -->
                <div id="edit-{{ $report->issue_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow ">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                            Edit Issue
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-{{ $report->issue_id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                    </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form class="space-y-4" action="{{ route('sa.updateIssue', $report->issue_id)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="pb-2">
                                        <label for="infrastructure_id" class="block mb-2 text-sm font-medium text-gray-900">Choose Infrastructure</label>
                                        <select type="text" name="infrastructure_id" id="infrastructure_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                            <option selected value="{{ $report->infrastructure_id }}">{{ $report->infrastructure_type }}</option>
                                            @foreach ($getInfrasrtuctures as $infrastructure)
                                                @if ( $report->infrastructure_type !==  $infrastructure->infrastructure_type)
                                                    <option value="{{ $infrastructure->infrastructure_id }}">{{ $infrastructure->infrastructure_type }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="pb-2">
                                        <input type="hidden" name="issue_id" id="issue_id" value="{{ $report->issue_id }}" required />
                                        <label for="issue" class="block mb-2 text-sm font-medium text-gray-900 ">Issue Title</label>
                                        <input type="text" name="issue" id="issue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="pothole, flooding, etc." value="{{ $report->issue_type }}" required />
                                    </div>
                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Row</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
