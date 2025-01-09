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
  <div class="flex m-w-full bg-transparent ml-56">
    <x-sa-data 
      :data="[
        'admins' => $admins, 
        'reports' => $reports, 
        'client' => $adminClients, 
        'infrastructures' => $infrastructures, 
        'issues' => $issues,]" />
  </div>
</body>
</html>
