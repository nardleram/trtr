@extends('layouts.errorLayout')

@section('content')

@php
    $object = ucfirst(substr($route, strrpos($route, "/") + 1));
@endphp

<div class="mx-auto w-full sm:w-[522px]">
    <h1 class="mb-12 text-rose-600 text-xl font-sans font-bold">Oops! Error: {{ $code }}</h1>

    <h2 class="text-white text-sm font-sans font-medium"><span class="text-slate-300">Message:</span> {{ $message }}</h2>
    <p class="mt-2 text-slate-200 text-sm font-sans font-normal">Description: {{ $description }}</p>

    <div class="w-24 mt-12 py-2 bg-rose-500 hover:bg-rose-600 rounded-lg shadow-md text-center transition-colors delay-100 duration-250">
        <a href="{{ route('/') }}" class="text-white text-sm no-underline font-sans">Home</a>
    </div>

</div>

@endsection