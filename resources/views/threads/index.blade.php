@extends('layouts.mainLayout')

@section('content')

<div class="grid grid-cols-12 gap-4 mt-[135px] sm:mt-[185px] md:mt-[250px] px-2 sm:px-12 md:px-20 lg:px-32">
    <div class="col-span-full row-start-1 h-8">
        <div class="w-full h-fit justify-self-end items-baseline">
            <h1 class="ml-1 text-base font-semibold mb-8">Forum</h1>
        </div>
    </div>

    <div class="col-span-12 sm:col-span-7 md:col-span-8 lg:col-span-9 row-start-2 items-start justify-items-start">
        <div class="w-full grid sm:col-start-1 sm:col-end-7 md:grid-cols-3cards gap-4 justify-items-start items-start">
            @forelse ($threads as $thread)
                <div class="w-full h-[266px] bg-gradient-to-r from-dBlue via-primaryBlue to-dBlue p-0.5 rounded-md shadow-md">
                    <div class="grid grid-rows-3 h-[262px] justify-between bg-slate-50 rounded-md p-3">
                        <div>
                            <h4 class="text-sm mb-2 font-semibold text-slate-900 tracking-tight">{{ $thread->title }}</h4>
        
                            <div class="flex justify-between">
                                <p class="text-xs font-light">{{ $thread->user->name }}</p>
                                <p class="text-xs font-light">{{ $thread->created_at->format('j M y, H:i') }}</p>
                            </div>
                        </div>
        
                        <div class="row-span-1 pt-2">
                            <p class="text-sm font-serif italic leading-snug">{{ Str::limit($thread->body, 150) }}</p>
                        </div>

                        <div class="mt-2">
                            <small class="text-xs text-dBlue">Comments: {{ $thread->comments->count() }}</small>
                        </div>
        
                        <div class="w-full relative">
                            <a href="{{ route('threads.show', $thread->id) }}" class="text-sm text-slate-100 hover:text-white transition-colors delay-100 duration-250">
                                <div class="w-full flex absolute bottom-0 h-8 items-center justify-between py-1 px-2 bg-gradient-to-b from-dBlue via-primaryBlue to-dBlue rounded-md">
                                    <p class="text-xs">Join the discussion</p>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg> 
                                </div>
                            </a>                  
                        </div>
                    </div>
                </div>
            @empty
                <p>No threads yet. Perhaps you would like to <a href="{{ route('register') }}">register</a> and start a discussion?</p>
            @endforelse
        </div>
    </div>

    {{-- <div class="col-span-12 sm:col-span-5 md:col-span-4 lg:col-span-3 row-start-3 sm:row-start-2">
        <x-sidebar></x-sidebar>

        @auth
        <div class="w-full py-2 mt-10 bg-rose-700 text-white  text-center rounded-md shadow-md hover:bg-rose-800 transition-colors delay-100 duration-250">
            <a href="{{ route('threads.create') }}">Add a thread</a>
        </div>
        @endauth
    </div> --}}
</div>

@endsection