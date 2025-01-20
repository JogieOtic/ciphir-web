@extends('sa-admin.manage-report-entities')
@section('title', 'Manage Infrastructures')
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
                    <tr>
                        <th scope="col" class="px-6 py-3">
                                ID #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Infrastructures
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color code <span class="italic lowercase tracking-wider">| hexvalue</span>
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
                @foreach ($infrastructureInformations as $report)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $report->infrastructure_id }}
                    </th>
                    <td class="px-6 py-4">
                            {{ $report->infrastructure_type }}
                    </td>
                    <td class="px-6 py-4 flex flex-row gap-2">
                            <div class="h-4 w-12" style="background-color:{{ $report->color_code }};"></div>
                            {{ $report->color_code }}
                    </td>

                    <td class="px-6 py-4 text-right">
                        <button data-modal-target="edit-{{ $report->infrastructure_id }}" data-modal-toggle="edit-{{ $report->infrastructure_id }}" class="font-medium text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pen-to-square text-lg"></i>
                        </button>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button data-modal-target="popup-{{ $report->infrastructure_id }}" data-modal-toggle="popup-{{ $report->infrastructure_id }}" class="font-medium text-red-600 hover:underline"><i class="fa-solid fa-trash-can text-lg"></i></button>
                    </td>
                </tr>
                {{-- Delete Modal --}}
                <div id="popup-{{ $report->infrastructure_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-fit max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-{{ $report->infrastructure_id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-5 text-center">
                                <svg class="mx-auto mb-4 text-red-600 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this infrastructure: <span class="text-blue-600 italic font-bold tracking-wider">{{$report->infrastructure_type}}</span>?</h3>
                                @foreach ($processedData as $category => $issues)
                                    @if($category === $report->infrastructure_type)
                                        <p class="text-sm text-red-600 pb-3 max-w-[760px] text-left">Deleting <span class="text-red-600 italic font-bold tracking-wider">{{$report->infrastructure_type}}</span> will affect the following issues;
                                            @foreach ($issues as $issue)
                                                <span class="tracking-wider">{{ $issue }},</span>
                                            @endforeach
                                        </p>
                                    @endif
                                @endforeach
                                <p class="text-sm text-gray-600 pb-3 max-w-[760px] text-center">If you wish to pursue the deletion for this certain infrastructure, the issues will also be deleted. Thank you for understanding. </p>
                                <form action="{{ route('sa.deleteInfrastructure', $report->infrastructure_id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-modal-hide="popup-{{ $report->infrastructure_id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I'm sure
                                    </button>
                                </form>
                                <button data-modal-hide="popup-{{ $report->infrastructure_id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Infrastructure modal -->
                <div id="edit-{{ $report->infrastructure_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow ">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                            Edit Infrastructure
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-{{ $report->infrastructure_id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                    </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form class="space-y-4" action="{{ route('sa.updateInfrastructure', $report->infrastructure_id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                    <div class="pb-2">
                                        <input type="text" name="infrastructure_id" id="infrastructure_id" hidden value="{{$report->infrastructure_id}}" required />
                                        <label for="infrastructure_type" class="block mb-2 text-sm font-medium text-gray-900 ">Infrastructure Type</label>
                                        <input type="text" name="infrastructure_type" id="infrastructure_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="roads, parks, etc." value="{{$report->infrastructure_type}}" required />
                                    </div>
                                    <div class="flex justify-between gap-4 pb-3">
                                        <div class="flex flex-row w-full justify-between items-center">
                                        <label for="password" class="flex mb-2 text-sm font-medium text-gray-900 ">Color Code <span class="italic"> (hex)</span></label>
                                        <input type="color" id="color_hex" name="color_hex" value="{{$report->color_code}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-12 h-full p-1.5" required>
                                        </div>

                                        <input type="text" id="hexValue" value="{{$report->color_code}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
