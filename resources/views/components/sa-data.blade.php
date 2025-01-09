<div class="w-full min-h-screen py-3 px-3 flex flex-col gap-4">
  <div class="py-2 px-3 bg-[#DDE8F0] rounded-md flex flex-row w-full gap-4">
    <div>
      <h5 class="text-xl font-medium text-gray-900 pb-2 pl-1">Data Counts</h5>
      <table class="w-1/2 table-auto border-collapse border border-gray-300 bg-blue-100">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 px-4 py-2 text-left">Admins</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Users</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Reports</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Infrastructures</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Issues</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-blue-200">
                <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $data['admins'] }}</td>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $data['client'] }}</td>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $data['reports'] }}</td>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $data['infrastructures'] }}</td>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $data['issues'] }}</td>
            </tr>
        </tbody>
      </table>
    </div>
    <div class="bg-red-300 w-full">
      asas
    </div>
  </div>
</div>