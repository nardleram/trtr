@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-56">
    <div class="w-full sm:w-1/2 md:w-1/3 mx-auto mt-[135px] sm:mt-[185px] md:mt-[250px] px-2 sm:px-0">

        <h1 class="mb-4 ml-1 font-sans text-sm font-semibold">Message board</h1>

        @auth
            <form action="{{ route('messages.store') }}" method="POST" class="font-sans font-light text-textBase mb-6">
                @csrf

                <div class="w-full">
                    <label for="message" class="mb-4 text-xs text-slate-400">Type message</label>
                    <textarea name="message" id="message" rows="10" class="w-full" required autofocus></textarea>
                </div>

                <button type="submit" class="w-full mt-3 py-2 bg-gradient-to-b from-rose-800 via-rose-600 to-rose-800 rounded-lg text-sm font-semibold text-rose-50 hover:shadow-md hover:text-white transition-all delay-100 duration-300">Send</button>
            </form>
        @endauth

        @forelse ($messages as $message)
        <div class="w-full mt-2 p-2 border border-slate-300 rounded-md shadow-sm">
            <p class="py-1 text-xs text-slate-400 font-light">{{ $message->user->name }}, {{ $message->created_at->format('j M Y, H:i:s') }}</p>
            <p class="text-xs">{!! nl2br(e($message->message)) !!} </p>
        </div>
        @empty
            <p class="mb-4 text-base font-serif">No artimessagescles found.</p>
        @endforelse
    </div>
</div>

@endsection