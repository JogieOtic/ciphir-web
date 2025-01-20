<!DOCTYPE html>
<html>
<head>
    <title>{{ $message['forbidden'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <div class="w-screen text-center pt-20 font-serif">
        <span>{{ $message['message'] }}</span>
        <hr>
        <span class="text-xs text-red-600">{{ $message['forbidden'] }}</span>
    </div>
</body>
</html>
