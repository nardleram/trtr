@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-52">
    <div class="m-auto w-full px-3 sm:p-0 sm:w-4/5 md:px-5 lg:w-1/2">
        <h1 class="text-slate-700 text-xl font-sans font-bold">Hey there, {{ $user->name }}!</h1>

        <form action="{{ route('users.update') }}" method="POST" class="mt-10">
            @csrf

            <label for="name" class="absolute pl-4 pt-2 text-textBase text-xs">Name</label>
            <input name="name" value="{{old('name', $user->name)}}" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="text" required autofocus>

            <label for="email" class="absolute pl-4 pt-2 text-textBase text-xs">Email</label>
            <input name="email" value="{{old('email', $user->email)}}" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="email" required>

            <label for="password" class="absolute pl-4 pt-2 text-textBase text-xs">Password</label>
            <input name="password" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md text-sm border-b border-slate-400 mb-2" type="password">

            <button type="submit" class="w-full mt-3 py-2 bg-rose-700 hover:bg-rose-800 rounded-lg shadow-md text-white transition-colors delay-100 duration-250">Update</button>
        </form>
    </div>
</div>

@endsection