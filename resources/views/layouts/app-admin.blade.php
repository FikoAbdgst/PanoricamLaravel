<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panoricam ' }}</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body class="bg-gray-100 overflow-x-hidden">
    <!-- Include the sidebar component -->
    @include('components.sidebar')

    <!-- Main content dengan padding left untuk desktop -->
    <main class="lg:ml-64 min-h-screen transition-all duration-300 ease-in-out">
        <!-- Content wrapper dengan padding top untuk mobile toggle button -->
        <div class="pt-16 lg:pt-6 px-4 lg:px-6">
            @yield('section')
        </div>
    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
