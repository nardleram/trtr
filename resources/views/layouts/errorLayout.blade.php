<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Truth Transparent</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite('resources/css/app.css')

        {{-- Scripts --}}
        @vite('resources/js/app.js')
    </head>

    <body class="antialiased font-serif">
        <main class="w-full bg-gradient-to-b from-slate-900 via-slate-800 to-textBase border-b-2 border-slate-600" style="min-height: -webkit-fill-available; min-height: 100vh;">
            {{-- logo --}}
            <div class="mx-auto w-logo sm:w-logoMedium md:w-logoLarge mb-10">
                <img src="/storage/images/truthtransparentNew.svg" alt="logo" class="h-[72px] sm:h-[120px] md:h-44">
            </div>

            <div class="w-full">
                @yield('content')
            </div>
        </main>
    </body>
</html>