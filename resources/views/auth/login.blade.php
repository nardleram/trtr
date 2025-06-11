@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-56">
    <div class="w-full sm:w-1/2 md:w-1/3 mx-auto mt-[135px] sm:mt-[185px] md:mt-[250px] px-2 sm:px-0">

        <h1 class="mb-4 ml-1 font-sans text-sm font-semibold">Log in</h1>

        <form action="{{ route('login') }}" method="POST" class="font-sans font-light text-textBase">
            @csrf

            <div class="w-full">
                <label for="name" class="absolute pl-4 pt-2 text-xs text-slate-400">Name</label>
                <input name="name" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="text" required autofocus>
            </div>

            <div class="w-full">
                <label for="email" class="absolute pl-4 pt-2 text-xs text-slate-400">Email</label>
                <input name="email" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="email" required>
            </div>

            <div class="w-full">
                <label for="password" class="absolute pl-4 pt-2 text-xs text-slate-400">Password</label>
                <input name="password" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password" required>
            </div>

            <button type="submit" class="w-full mt-3 py-2 bg-gradient-to-b from-rose-800 via-rose-600 to-rose-800 rounded-lg text-sm font-semibold text-rose-50 hover:shadow-md hover:text-white transition-all delay-100 duration-300">Log in</button>
        </form>
        <p class="mt-4 ml-1 font-sans text-sm">Would you like to <a class="text-dBlue hover:text-primaryBlue font-sans" href="{{ route('register') }}">register?</a></p>
    </div>
</div>

@endsection