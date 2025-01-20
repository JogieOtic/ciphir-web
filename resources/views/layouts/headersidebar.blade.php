<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/Web System logo.png') }}" type="image/png">

    <title>@yield('title', 'Ciphir')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter text-sm">
  <div>
		<x-status />
	</div>
	<!-- Include header -->
  @include('components.header')
	<!-- Include sidebar -->
  @if (Auth::check())
    @include('components.sidebar') 
    <main class="ml-56 pt-16">
      @yield('content') <!-- Dynamic content -->
    </main> 
  @else  
    <main>
      @yield('content') <!-- Dynamic content -->
    </main>  
  @endif
</body>
</html>
