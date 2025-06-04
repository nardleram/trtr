@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-56">
    <div class="w-full sm:w-1/2 md:w-1/3 mx-auto mt-[135px] sm:mt-[185px] md:mt-[250px] px-2 sm:px-0">
        <p>Please check your email inbox; a message detailing how to complete your registration awaits your attention.</p>
        <p class="text-sm">(If not, perhaps check your spam folder.)</p>

        <p class="text-sm">Received no email? Click the button below to send another.</p>

        <form action="{{ route('verification.send', auth()->id()) }}" method="POST">
            @csrf
            <button class="w-full mt-3 py-2 bg-rose-700 hover:bg-rose-800 rounded-lg shadow-md text-white transition-colors delay-100 duration-250" type="submit">Resend email</button>
        </form>
    </div>
</div>