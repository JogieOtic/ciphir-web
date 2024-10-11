<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Header & Sidebar')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Link to Font Awesome -->
    <link href="/css/dashboardpage.css" rel="stylesheet">
    <link href="/css/notificationpage.css" rel="stylesheet">
</head>
<body>
    @include('partials.header')  <!-- Include header -->
    @include('partials.sidebar') <!-- Include sidebar -->

    <main>
        @yield('content') <!-- Dynamic content -->
    </main>
</body>
</html>
