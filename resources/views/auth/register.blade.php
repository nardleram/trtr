@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-56">
    <div class="w-full sm:w-1/2 md:w-1/3 mx-auto mt-[135px] sm:mt-[185px] md:mt-[250px] px-2 sm:px-0">

        <h1 class="mb-4 ml-1 font-sans text-sm font-semibold">Register</h1>

        <form action="{{ route('storeUser') }}" method="POST" class="font-sans font-light text-textBase">
            @csrf

            <div class="w-full">
                <label for="name" class="absolute pl-4 pt-2 text-xs text-slate-400">Name</label>
                <input name="name" class="w-full -mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="text" required autofocus>
                @error('name')
                <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                    <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="w-full">
                <label for="email" class="absolute pl-4 pt-2 text-xs text-slate-400">Email</label>
                <input name="email" class="w-full -mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="email" required>
                @error('email')
                <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                    <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="w-full">
                <label for="password" class="absolute pl-4 pt-2 text-xs text-slate-400">Password</label>
                <input name="password" class="w-full -mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password" required>
                @error('password')
                <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                    <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="w-full">
                <label for="password_confirmation" class="absolute pl-4 pt-2 text-xs text-slate-400">Confirm password</label>
                <input name="password_confirmation" class="w-full -mt-1 pl-4 pt-9 pb-4 shadow-sm h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password" required>
                @error('password_confirmation')
                <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                    <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <button type="submit" class="w-full mt-3 py-2 bg-gradient-to-b from-rose-800 via-rose-600 to-rose-800 rounded-lg text-sm font-semibold text-rose-50 hover:shadow-md hover:text-white transition-all delay-100 duration-300">Register</button>
        </form>
        <p class="mt-4 ml-1 font-sans text-sm">Would you like to <a class="text-dBlue hover:text-primaryBlue font-sans" href="{{ route('login') }}">log in?</a></p>
    </div>
</div>

@endsection