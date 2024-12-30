<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ciphir')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    {{-- <link href="/css/dashboardpage.css" rel="stylesheet">
    <link href="/css/notificationpage.css" rel="stylesheet">
    <link href="/css/headersidebar.css" rel="stylesheet">
    <link href="/css/reportdetailpage.css" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
	<!-- Include header -->
  @include('components.header')
	<!-- Include sidebar -->
  {{-- @include('components.sidebar')  --}}

  <main>
    @yield('content') <!-- Dynamic content -->
  </main>
</body>
</html>
