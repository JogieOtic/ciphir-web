<div class="flex flex-col w-full gap-6">
	<div class="relative flex flex-col h-auto bg-[#DDE8F0] p-4 w-full rounded-md shadow-md">
		<div class="relative rounded-md overflow-clip">
			<table class="w-full text-sm text-left rtl:text-right text-gray-500 max-h-1/2 shadow-xl">
				<caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">
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
				</caption>
				<thead class="text-xs text-gray-700 uppercase bg-gray-50">
						<tr>
								<th scope="col" class="px-6 py-3">
										Username
								</th>
								<th scope="col" class="px-6 py-3">
										ID #
								</th>
								<th scope="col" class="px-6 py-3">
										Role
								{{-- </th>
								<th scope="col" class="px-6 py-3">
										<span class="sr-only">Edit</span>
								</th> --}}
						</tr>
				</thead>
				<tbody>
					@foreach ($dataEntity['admins'] as $report)
					<tr class="bg-white border-b">
						<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
								{{ $report->Username }}
						</th>
						<td class="px-6 py-4">
								00{{ $report->Admin_ID }}
						</td>
						<td class="px-6 py-4">
								{{ $report->Role }}
						</td>
						{{-- <td class="px-6 py-4 text-right">
								<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
						</td> --}}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="relative flex flex-col h-auto bg-[#DDE8F0] p-4 w-full rounded-md shadow-md">
		<div class="relative rounded-md overflow-clip">
			<table class="w-full text-sm text-left rtl:text-right text-gray-500 max-h-1/2 shadow-xl">
				<caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">
					<div class="flex flex-row justify-between w-full h-fit">
						<div class="flex items-center uppercase">
							Residents
						</div>
						<div class="mt-1 text-base font-normal text-gray-500">
							<a 
								href="{{ route('residents') }}"
								class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600"
							>Show All</a>
						</div>
					</div>
					
				</caption>
				<thead class="text-xs text-gray-700 uppercase bg-gray-50">
						<tr>
								<th scope="col" class="px-6 py-3">
										Username
								</th>
								<th scope="col" class="px-6 py-3">
										ID #
								</th>
								<th scope="col" class="px-6 py-3">
										Fullname
								</th>
								<th scope="col" class="px-6 py-3">
									Address
								</th>
								{{-- <th scope="col" class="px-6 py-3">
										<span class="sr-only">Edit</span>
								</th> --}}
						</tr>
				</thead>
				<tbody>
					@foreach ($dataEntity['residents'] as $report)
					<tr class="bg-white border-b">
						<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
								{{ $report->username }}
						</th>
						<td class="px-6 py-4">
								00{{ $report->resident_id }}
						</td>
						<td class="px-6 py-4">
								{{ $report->fullname }}
						</td>
						<td class="px-6 py-4">
								{{ $report->address }}
						</td>
						{{-- <td class="px-6 py-4 text-right">
								<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
						</td> --}}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>