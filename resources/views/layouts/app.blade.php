<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        {{-- font awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 h-100" id="body">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                {{-- <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div> --}}
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    {{-- <script src="{{ asset('libs/three.r119.min.js') }}"></script>
    <script src="{{ asset('libs/vanta.net.min.js') }}"></script> --}}
    <script>
        // VANTA.NET({
        //   el: "#body",
        //   mouseControls: true,
        //   touchControls: true,
        //   gyroControls: false,
        //   minHeight: 200.00,
        //   minWidth: 200.00,
        //   scale: 1.00,
        //   scaleMobile: 1.00,
        //   color: 0xff00ff,
        //   backgroundColor: 0x0ffffff,
        //   points: 20.00,
        //   maxDistance: 28.00,
        //   spacing: 20.00
        // })

        // document.querySelector('canvas').setAttribute('width', '100%')
    </script>
    <style>
        canvas {
            height: 100% !important;
        }
    </style>
</html>
