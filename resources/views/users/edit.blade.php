@extends('layouts.mainLayout')

@section('content')

<x-popup></x-popup>

<div class="mt-[88px] sm:mt-[140px] md:mt-52">
    <div class="m-auto w-full px-3 sm:p-0 sm:w-4/5 md:px-5 lg:w-1/2">
        <h1 class="text-slate-700 text-xl font-sans font-bold">Hey there, {{ $user->name }}!</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-10">
            @csrf
            @method("PUT")

            <label for="name" class="absolute pl-4 pt-2 text-textBase text-xs">Name</label>
            <input name="name" value="{{old('name', $user->name)}}" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="text" autofocus>
            @error('name')
            <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                </svg>
                {{ $message }}
            </p>
            @enderror

            <label for="email" class="absolute pl-4 pt-2 text-textBase text-xs">Email</label>
            <input name="email" value="{{old('email', $user->email)}}" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="email">
            @error('email')
            <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                </svg>
                {{ $message }}
            </p>
            @enderror

            <label for="password" class="absolute pl-4 pt-2 text-textBase text-xs">Current password (required)</label>
            <input name="password" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password" required>
            @error('password')
            <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                </svg>
                {{ $message }}
            </p>
            @enderror

            <label for="newpassword" class="absolute pl-4 pt-2 text-textBase text-xs">New password</label>
            <input name="newpassword" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password">
            @error('newpassword')
            <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                </svg>
                {{ $message }}
            </p>
            @enderror

            <label for="newpassword_confirmation" class="absolute pl-4 pt-2 text-textBase text-xs">Confirm new password</label>
            <input name="newpassword_confirmation" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password">
            @error('newpassword_confirmation')
            <p class="-mt-1 mb-4 ml-2 text-xs font-semibold text-red-600">
                <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                </svg>
                {{ $message }}
            </p>
            @enderror

            <button type="submit" class="w-full mt-3 py-2 bg-rose-700 hover:bg-rose-800 rounded-lg shadow-md text-white transition-colors delay-100 duration-250">Update</button>
        </form>
    </div>
</div>

@endsection