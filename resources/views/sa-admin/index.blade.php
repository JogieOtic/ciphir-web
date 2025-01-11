<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->Role === 'SA' ? 'Welcome, Ciphir' : 'Ciphir'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>
<body>
  <x-sa-sidebar/>
  <div class="flex m-w-full ml-56">
    <div class="w-full max-w-[1440px] mx-auto h-full min-h-screen pb-4 pt-10 flex flex-row gap-6">
      <x-all-users-info :dataEntity="$dataEntity"/>
      <x-sa-data :dataCounts="$dataCounts" :dataEntity="$dataEntity"/>
    </div>
  </div>
</body>
</html>
