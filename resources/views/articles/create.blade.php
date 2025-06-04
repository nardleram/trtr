@extends('layouts.mainLayout')

@section('content')

<div class="mt-[135px] sm:mt-[155px] md:mt-[220px] px-2 sm:px-12 md:px-20 lg:px-32">

    <div class="justify-self-end items-baseline w-full h-fit">
        <h1 class="mb-6 ml-1 text-base font-semibold">Create article</h1>
    </div>

    @if ($errors->has('slug'))
    <p class="text-xs font-semibold text-red-600">Don't forget the slug bruv</p>
    @endif

    <div>
        @auth
            <div class="mb-8 w-full sm:w-2/3">
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="source" value="app">

                    <label for="title" class="ml-2 text-xs text-textBase font-semibold">Thread title</label>
                    <input name="title" value="{{ old('title') }}" class="px-4 mb-4 w-full h-12 text-sm rounded-md border-b shadow-sm text-textBase focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md border-slate-400" type="text" required autofocus>
                    @error('title')
                    <p class="-mt-3 mb-4 ml-2 text-xs font-semibold text-red-600">
                        <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror

                    <label for="main_image" class="ml-2 text-xs text-textBase font-semibold">Main image</label>
                    <input type="file" name="main_image" class="mb-4 w-full h-12 text-xs rounded-md border focus:outline-1 focus:outline-primaryBlue border-slate-400 focus:shadow-md file:border-0 file:bg-dBlue file:mr-4 file:py-4 file:px-4 file:text-white" required></input>
                    @error('main_image')
                    <p class="-mt-3 mb-4 ml-2 text-xs font-semibold text-red-600">
                        <svg class="w-4 h-4 ml-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror

                    <p class="ml-2 mt-1 mb-1 text-xs text-textBase font-semibold">Select category</p>
                    <div class="ml-2 mb-3 flex gap-2 flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/3">
                            <input type="radio" name="category" value="consciousness" {{ old('category') === 'consciousness' ? 'checked' : '' }}></input>
                            <label for="consciousness" class="text-xs text-textBase font-light">consciousness</label>
                        </div>

                        <div class="w-full sm:w-1/2 md:w-1/3">
                            <input type="radio" name="category" value="love_wisdom_health" {{ old('category') === 'love_wisdom_health' ? 'checked' : '' }}></input>
                            <label for="love_wisdom_health" class="text-xs text-textBase font-light">love-wisdom-health</label>
                        </div>

                        <div class="w-full sm:w-1/2 md:w-1/3">
                            <input type="radio" name="category" value="group dynamics" {{ old('category') === 'group_dynamics' ? 'checked' : '' }}></input>
                            <label for="group dynamics" class="text-xs text-textBase font-light">group dynamics</label>
                        </div>
                        
                        <div class="w-full sm:w-1/2 md:w-1/3">
                            <input type="radio" name="category" value="money" {{ old('category') === 'money' ? 'checked' : '' }}></input>
                            <label for="money" class="text-xs text-textBase font-light">money</label>
                        </div>

                        <div class="w-full sm:w-1/2 md:w-1/3">
                            <input type="radio" name="category" value="politics_geoplitics" {{ old('category') === 'politics_geoplitics' ? 'checked' : '' }}></input>
                            <label for="politics_geoplitics" class="text-xs text-textBase font-light">politics & geoplitics</label>
                        </div>
                    </div>

                    <div>
                        <label for="seo" class="block ml-2 mb-1 text-xs text-textBase font-semibold">SEO text</label>
                        <textarea name="seo" id="seo" class="px-4 mb-4 w-full text-sm rounded-md border-b shadow-sm text-textBase focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md border-slate-400" cols="30" rows="4">{{ old('seo') ? old('seo') : '' }}</textarea>
                    </div>

                    <div>
                        <label for="keywords" class="block ml-2 mb-1 text-xs text-textBase font-semibold">Keywords</label>
                        <textarea name="keywords" id="keywords" class="px-4 mb-4 w-full text-sm rounded-md border-b shadow-sm text-textBase focus:border-primaryBlue focus:ring-1 focus:ring-primaryBlue focus:shadow-md border-slate-400" cols="30" rows="2">{{ old('keywords') ? old('keywords') : '' }}</textarea>
                    </div>

                    <label for="body" class="ml-2 text-xs text-textBase font-semibold">Body text</label>
                    <x-forms.tinymce-editor-article body="{{ old('body') ? old('body') : '' }}" />

                    <button type="submit" class="px-5 py-2 mt-6 w-32 text-xs font-semibold text-center text-white bg-dBlue rounded-md transition-shadow delay-100 hover:shadow-md duration-250">Save</button>
                </form>
            </div>
        @endauth
    </div>
</div>

@endsection