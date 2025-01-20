<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome, Ciphir')</title>
    <link rel="icon" href="{{ asset('img/Web System logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="text-sm font-inter">
  @include('components.sa-sidebar')
  <div>
		<x-status />
	</div>
  <div class="flex m-w-full ml-56">
    <div class="w-full max-w-[1440px] mx-auto h-full min-h-screen pb-4 pt-10 px-4">
      <section>
        @yield('content')
      </section>
    </div>
  </div>
</body>
</script>	
</html>
