<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->Role === 'SA' ? 'Welcome, Ciphir' : 'Ciphir'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-sa-sidebar/>
    <div class="flex m-w-full bg-white ml-56">
    <div class="bg-slate-50 w-full max-h-screen py-3 px-3 flex flex-col gap-4">
      <div class="py-2 px-3 bg-[#DDE8F0] rounded-md">
        <span class="text-3xl font-medium">Dashboard</span>
      </div>
      <div class="py-2 px-3 bg-[#DDE8F0] rounded-md h-full">
        <table class="w-full table-auto border-collapse border border-gray-300 bg-blue-100">
          <thead>
              <tr class="bg-blue-500 text-white">
                  <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Username</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Edit</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($users as $admin)
              <tr class="hover:bg-blue-200">
                  <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $admin->Admin_ID }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $admin->Role === 'SA' ? 'Super Admin' : 'Admin' }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ $admin->Username }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ 'Edit Icon' }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700">{{ 'UP' }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
      
      </div>
    </div>
  </div>
</body>
</html>
