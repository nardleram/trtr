@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-52">
    <div class="m-auto w-full px-3 sm:p-0 sm:w-4/5 md:w-1/2 lg:w-1/3">
        <h1 class="text-6xl text-center font-light mb-8 tracking-tight">Add a new forum thread</h1>

        <form action="{{ route('thread.store') }}" method="POST" class="mt-5">
            @csrf

            <label for="title" class="absolute pl-4 pt-2 text-textBase text-xs">Thread title</label>
            <input name="title" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase h-8 rounded-lg focus:border-rose-800 focus:ring-1 focus:ring-rose-800 focus:shadow-md text-sm border-b border-slate-400 mb-2" type="text" required autofocus>

            <label for="body" class="absolute pl-4 pt-2 text-textBase text-xs">Body</label>
            <textarea name="body" rows="6" class="w-full mt-1 pl-4 pt-9 pb-4 shadow-sm text-textBase rounded-lg focus:border-rose-800 focus:ring-1 focus:ring-rose-800 focus:shadow-md text-sm border-b border-slate-400 mb-2" required></textarea>

            <button type="submit" class="w-full mt-3 py-2 bg-rose-700 hover:bg-rose-800 rounded-lg shadow-md text-white transition-colors delay-100 duration-250">Add new forum thread</button>
        </form>
    </div>
</div>

@endsection