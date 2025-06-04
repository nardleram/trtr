<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {!! SEO::generate(true) !!}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Sora:wght@100..800&display=swap" rel="stylesheet">

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff"> 

        <!-- Styles -->
        @vite('resources/css/app.css')

        {{-- Scripts --}}
        @vite('resources/js/app.js')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <x-head.tinymce-config/>
    </head>

    <body class="antialiased font-sans text-textBase">
        <nav class="absolute top-0 h-[82px] sm:h-[124px] md:h-[180px] w-full bg-gradient-to-b from-slate-900 to-slate-800" aria-label="non-mobile">
            {{-- logo --}}
            <div class="ml-3 sm:mx-auto mt-[14px] sm:mt-2 w-logo sm:w-logoMedium md:w-logoLarge">
                <img src="/storage/images/truthtransparentNew.svg" alt="logo" class="h-[55px] sm:h-[85px] md:h-[130px]">
            </div>

            {{-- main nav --}}
            <div x-data="{ open: false }" class="sm:absolute -mt-[62px] sm:mt-0.5 md:mt-1.5 right-10 sm:left-1/4 md:left-1/3 md:ml-2 sm:w-1/2 md:w-1/3">
                <div class="invisible sm:visible flex flex-nowrap justify-between items-center z-50 max-w-[420px] min-w-[50px] mx-auto pt-1.5">
                    {{-- menu --}}
                    <a href="{{ route('/') }}" @class([
                        'text-sm',
                        'text-slate-400',
                        'font-sans',
                        'font-light',
                        'uppercase',
                        'hover:text-white',
                        'hover:no-underline',
                        'cursor-pointer',
                        'transition-colors',
                        'delay-100',
                        'duration-250',
                        'border-b-2' => request()->is('/'),
                        'border-b-primaryBlue' => request()->is('/'),
                        'rounded-sm' => request()->is('/'),
                        'text-white' => request()->is('/'),
                    ])>
                        About
                    </a>
                    <a href="{{ route('biases') }}" @class([
                        'text-sm',
                        'text-slate-400',
                        'font-sans',
                        'font-light',
                        'uppercase',
                        'hover:text-white',
                        'hover:no-underline',
                        'cursor-pointer',
                        'transition-colors',
                        'delay-100',
                        'duration-250',
                        'border-b-2' => request()->is('biases'),
                        'border-b-primaryBlue' => request()->is('biases'),
                        'rounded-sm' => request()->is('biases'),
                        'text-white' => request()->is('biases'),
                    ])>
                        Biases
                    </a>
                    <a href="{{ route('articles.index') }}" @class([
                        'text-sm',
                        'text-slate-400',
                        'font-sans',
                        'font-light',
                        'uppercase',
                        'hover:text-white',
                        'hover:no-underline',
                        'cursor-pointer',
                        'transition-colors',
                        'delay-100',
                        'duration-250',
                        'border-b-2' => request()->is('articles'),
                        'border-b-primaryBlue' => request()->is('articles'),
                        'rounded-sm' => request()->is('articles'),
                        'text-white' => request()->is('articles'),
                    ])>
                        Articles
                    </a>
                </div>

                <div x-on:click="open = !open" class="visible sm:invisible absolute top-5 right-5 w-11 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>

                {{-- mobile menu --}}
                <div x-show="open" class="absolute visible sm:invisible top-[82px] left-0 w-full flex flex-wrap p-4 font-sans font-light uppercase text-sm text-slate-400 bg-slate-900 opacity-90 border-t border-slate-300 z-50">
                    <a href="{{ route('/') }}" class="w-full mb-3 text-sm text-slate-400 font-sans font-light uppercase hover:text-white hover:no-underline cursor-pointer transition-colors delay-100 duration-250">About</a>
                    <a href="{{ route('biases') }}" class="w-full mb-3 text-sm text-slate-400 font-sans font-light uppercase hover:text-white hover:no-underline cursor-pointer transition-colors delay-100 duration-250">Biases</a>
                    <a href="{{ route('articles.index') }}" class="w-full mb-3 text-sm text-slate-400 font-sans font-light uppercase hover:text-white hover:no-underline cursor-pointer transition-colors delay-100 duration-250">Articles</a>

                    @guest
                    <a href="{{ route('login') }}" class="w-full text-sm text-slate-400 font-sans font-light uppercase hover:text-white hover:no-underline cursor-pointer transition-colors delay-100 duration-250">
                        Login            
                    </a>
                    @endguest
                    @auth
                    <div class="flex flex-col">
                        <form action="/logout" method="POST" class="mb-2">
                            @method('DELETE')                    
                            @csrf
                            <button type="submit" class="text-xl hover:text-white cursor-pointer transition-colors delay-100 duration-250">
                                Logout                     
                            </button>
                        </form>
        
                        <form action="{{ route('users.edit', auth()->user()) }}">                  
                            @csrf
                            <button type="submit" class="text-xl hover:text-white cursor-pointer transition-colors delay-100 duration-250">
                                Edit user            
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>

            {{-- login/register nav --}}
            <div class="invisible sm:visible absolute right-3 top-1 flex flex-row text-center rounded-lg p-3">
                @guest
                    <a href="{{ route('login') }}" class="text-lg font-medium md:text-2xl md:font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-rose-600 hover:text-white cursor-pointer transition-colors duration-350">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>                      
                    </a>
                @endguest

                @auth
                    @if (auth()->user()->is_verified())
                        <div class="flex flex-col items-center">
                            <form action="/logout" method="POST">
                                @method('DELETE')                    
                                @csrf
                                <button type="submit" class="text-lg font-medium md:text-2xl md:font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-rose-600 hover:text-white cursor-pointer transition-colors delay-100 duration-350">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>                      
                                </button>
                            </form>
            
                            <form action="{{ route('users.edit', auth()->user()) }}">                  
                                @csrf
                                <button type="submit" class="mt-1 text-2xl font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-rose-600 hover:text-white cursor-pointer transition-colors delay-100 duration-350">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>              
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth             
            </div>

            {{-- hamburger --}}
        </nav>

        @yield('content')
    </body>
</html>
