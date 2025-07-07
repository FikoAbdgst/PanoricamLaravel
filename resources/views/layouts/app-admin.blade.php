<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Panoricam Admin' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    {{-- jQuery dan Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- Tailwind CSS via CDN - Paling reliable --}}
    <script src="https://cdn.tailwindcss.com"></script>



    @stack('styles')
</head>

<body class="bg-gray-100 overflow-x-hidden">
    {{-- Include the sidebar component --}}
    @include('components.sidebar')

    {{-- Main content dengan padding left untuk desktop --}}
    <main class="lg:ml-64 min-h-screen transition-all duration-300 ease-in-out">
        {{-- Content wrapper dengan padding top untuk mobile toggle button --}}
        <div class="pt-16 lg:pt-6 px-4 lg:px-6">
            @yield('section')
        </div>
    </main>

    @stack('scripts')
</body>

</html>
