@extends('layouts.mainLayout')

@section('content')

<x-popup></x-popup>

<div class="max-w-[1240px] mx-auto grid grid-cols-12 gap-4 mt-[135px] smArticles:mt-[155px] md:mt-[220px] px-2 smArticles:px-12 md:px-20 lg:px-32">
    <div class="col-span-full row-start-1 h-6">
        <div class="w-full h-fit justify-self-end items-baseline">
            <h1 class="ml-1 text-base font-semibold">Articles</h1>
        </div>
    </div>

    <div class="col-span-12 smArticles:col-span-7 mdArticles:col-span-8 lg:col-span-9 row-start-2 items-start justify-items-start">
        <div class="w-full grid smArticles:col-start-1 smArticles:col-end-7 md:grid-cols-2cards lg:grid-cols-2cardsLg gap-4 justify-items-start items-start">

            @forelse ($articles as $article)
                @if ($category === '' || $category === $article->category)
                    <div class="w-full h-[396px] bg-gradient-to-r from-slate-50 via-primaryBlue to-dBlue p-0.5 rounded-md">
                        <div class="grid gap-0 h-[392px] justify-between bg-slate-50 rounded-md p-0">
                            <div class="w-full h-[160px] mx-auto rounded-t-md">
                                @if ($article->main_image)
                                <img class="w-full h-[160px] object-cover rounded-t-md" src="/storage/{{$article->main_image}}" alt="Main image">
                                @else
                                <img class="w-full h-[160px] object-cover rounded-t-md" src="/storage/images/articles/default.jpg" alt="Default image">
                                @endif
                            </div>

                            <div class="px-3">
                                <a href="{{ route('articles.show', $article->slug) }}" class="font-sans hover:no-underline">
                                    <h4 class="text-sm font-semibold text-textBase tracking-tight cursor-pointer">{{ $article->title }}</h4>
                                </a>
            
                                <div class="flex flex-wrap h-7 justify-between items-center">
                                    <div class="w-fit h-6">
                                        <p class="py-1 text-xs text-slate-400 font-light">{{ $article->user->name }}, {{ $article->created_at->format('j M Y') }}</p>
                                    </div>
                                    <div @class([
                                        'px-2',
                                        'py-1',
                                        'h-6',
                                        'w-fit',
                                        'rounded-md',
                                        'bg-sky-100' => $article->category === 'consciousness',
                                        'bg-emerald-100' => $article->category === 'love-wisdom-health',
                                        'bg-violet-100' => $article->category === 'group dynamics',
                                        'bg-amber-200' => $article->category === 'money',
                                        'bg-pink-200' => $article->category === 'politics & geopolitics',
                                        ])>
                                        <p class="text-xs text-textBase font-normal">{{ $article->category }}</p>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row-span-1 h-[72px] px-3">
                                <p class="text-sm text-textBase font-serif italic leading-snug">{{ $article->seo }}</p>
                            </div>

                            <div class="flex flex-nowrap justify-between items-center px-3">
                                <a href="{{ route('articles.show', $article->slug) }}" class="hover:no-underline">
                                    <div class="py-1 px-4 text-rose-100 text-xs font-sans font-medium bg-gradient-to-b from-rose-800 via-rose-600 to-rose-800 rounded-md hover:text-white hover:shadow-md cursor-pointer">Read more</div>
                                </a>
                                <small class="text-xs text-primaryBlue">Comments: {{ $article->comments->count() }}</small>
                            </div>
            
                            
                            @if (auth()->user() &&  (auth()->user()->is_author() || auth()->user()->is_admin()) && auth()->id() === $article->user_id )
                                <div class="w-full mt-3 flex gap-3 justify-end px-3">
                                    <a href="{{ route('article.edit', $article->slug) }}" class="text-sm text-slate-500 hover:text-primaryBlue transition-colors delay-100 duration-250">
                                        <div class="w-fit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                                            </svg>
                                        </div>
                                    </a>
                                    <a href="{{ route('article.delete', $article->slug) }}" class="text-sm text-slate-500 hover:text-red-600 transition-colors delay-100 duration-250">
                                        <div class="w-fit">
                                            <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            @endif               
                        </div>
                    </div>
                @endif
            @empty
                <p class="mb-4 text-base font-serif">No articles found, sucker! Why not try harder next time.</p>
            @endforelse
        
        </div>
        
        <div class="w-full my-6">
            {{ $articles->links('pagination::tailwind') }}
        </div>
    </div>

    <div class="col-span-12 smArticles:col-span-5 mdArticles:col-span- lg:col-span-3 row-start-3 smArticles:row-start-2">
        <x-sidebar :articles=$articles></x-sidebar>

        @auth
            @if (auth()->user()->is_admin() || auth()->user()->is_author())
            <div class="w-full py-2 mt-10 text-white text-sm text-center rounded-md bg-gradient-to-b from-rose-800 via-rose-600 to-rose-800 hover:shadow-md transition-colors delay-100 duration-250">
                <a href="{{ route('articles.create') }}" class="text-rose-100 text-xs font-sans hover:text-white hover:no-underline">Add an article</a>
            </div>
            @endif 
        @endauth       
    </div>
</div>

@endsection