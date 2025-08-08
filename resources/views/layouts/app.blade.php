
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>    
    <link rel="icon" href="{{ asset('logo.jpg') }}" type="image/jpeg">
    @wireUiStyles
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body>
    <x-notifications />
    <div class="bg-blue-600 min-h-screen flex items-center justify-center p-4">
        {{ $slot }}       
    </div>
    @livewireScripts
    @wireUiScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>

