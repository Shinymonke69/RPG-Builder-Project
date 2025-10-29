<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>RPG-Builder</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#4e342e] dark:bg-[#2d2220] relative">
        {{-- Imagens nos cantos (customize o src depois!) --}}
        <img src="/images/left_tavern.jpg" 
            alt="Decoração esquerda" 
            class="absolute left-0 top-0 h-full w-24 object-cover z-10 hidden md:block" />
        <img src="/images/right_tavern.jpg"
            alt="Decoração direita"
            class="absolute right-0 top-0 h-full w-24 object-cover z-10 hidden md:block" />

        <div class="min-h-screen relative z-20 flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-[#6d4c41] dark:bg-[#3e2922] shadow text-white flex justify-center items-center py-6">
                    <h1 class="text-3xl font-extrabold tracking-widest font-serif text-center">RPG-Builder</h1>
                </header>
            @endisset

            <main class="flex-grow">
                @yield('slot')
            </main>
        </div>
    </body>
</html>