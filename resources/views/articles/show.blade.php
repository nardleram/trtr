@extends('layouts.mainLayout')

@php
    $stripped = strip_tags($article->body);
    $decoded = html_entity_decode($stripped);
    $wc = str_word_count($decoded);
    $mins = round($wc / 120);
@endphp

@section('title')
| {{ $article->title }}
@endsection

@section('meta_keywords'){{ str_replace('\r', '', $article->keywords) }}@endsection

@section('meta_description'){{ str_replace('\r', '', $article->seo) }}@endsection

@section('content')

<x-popup></x-popup>

<div class="max-w-[920px] min-w-[50px] mx-auto grid grid-cols-12 gap-3 sm:gap-4 md:gap-6 mt-[135px] sm:mt-[155px] md:mt-[220px] px-2 sm:px-4 md:px-6">
    <div class="row-start-1 col-span-12">
        <h1 class="text-slate-700 text-xl font-sans font-bold">{{ $article->title }}</h1>

        <div class="flex flex-wrap h-7 items-center">
            <div class="w-fit h-6">
                <p class="mr-6 py-1 text-xs text-slate-400 font-light">{{ $article->user->name }}, {{ $article->created_at->format('j M Y') }}</p>
            </div>

            <div @class([
                'px-2',
                'py-1',
                'h-6',
                'w-fit',
                'rounded-md',
                'bg-sky-100' => $article->category === 'consciousness',
                'bg-emerald-100' => $article->category === 'love-wisdom-health',
                'bg-violet-200' => $article->category === 'group dynamics',
                'bg-amber-200' => $article->category === 'money',
                'bg-pink-200' => $article->category === 'politics & geopolitics',
                ])>
                <p class="text-xs text-textBase">{{ $article->category }}</p>
            </div>
        </div>
        <p class="mt-2 text-xs text-slate-400">Approx. reading time: {{ $mins }} minutes ({{ $wc }} words)</p>
        @if ($article->updated_at)
        <p class="mt-4 text-xs text-primaryBlue">Last edit: {{ $article->updated_at->format('j M Y') }}</p>
        @endif
    </div>

    <div class="col-span-12 sm:col-span-8 row-start-2 items-start justify-items-start text-base font-serif pr-3">
        @if ($article->main_image)
        <img class="w-full mb-8 object-cover border border-slate-400 rounded-md shadow-md" src="/storage/{{$article->main_image}}" alt="Main image">
        @else
        <img class="w-full mb-8 object-cover border border-slate-400 rounded-md shadow-md" src="/storage/images/articles/default.jpg" alt="Default image">
        @endif

        {!! $article->body !!}

        @auth
            <h4 class="mt-8 mb-2 text-sm font-medium font-sans">Respond to article</h4>

            <div class="w-full sm:w-[95%] mb-8">
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_id" value="{{ $article->id }}">
                    <input type="hidden" name="commentable_type" value="App\Models\Article">
                    <input type="hidden" name="parent_id" value="{{ $article->id }}">
                    <input type="hidden" name="parent_type" value="App\Models\Article">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="indent_level" value="{{ 0 }}">

                    <x-forms.tinymce-editor-forum/>

                    <button type="submit" class="py-2 px-5 mt-3 bg-rose-700 text-white  text-center rounded-md shadow-md hover:bg-rose-800 transition-colors delay-100 duration-250">Save response</button>
                </form>
            </div>
        @endauth

        <div class="flex items-center justify-between mt-8 mb-2">
            @if ($article->comments->count() > 0)
                <h4 class="mr-4 text-sm font-sans font-medium">Comments</h4>
            @endif

            @guest
                <a href="{{ route('login') }}" class="text-dBlue text-xs font-sans hover:no-underline hover:text-primaryBlue transition-colors delay-100 duration-250">
                    Log in to join the conversation
                </a>
            @endguest
        </div>

        @forelse ($article->comments as $comment)
        <div class="w-full mb-5 p-indent-{{ $comment->indent_level > 2 ? 2 : $comment->indent_level }} md:p-indent-{{ $comment->indent_level }}">
            <div class="flex flex-col md:flex-row mb-2 pt-2 border-t border-t-slate-200">
                <div class="flex flex-row md:block md:flex-none w-full md:w-1/4 md:mr-2 mb-2 md:mb-0 font-sans">
                    <p class="text-dBlue italic text-xs mb-1 mr-1 md:mr-0">{{ $comment->comment_author }}</p>
                    <p class="text-dBlue italic text-xs mb-1 mr-1 md:mr-0">{{ $comment->created_at->format('j M y, H:i') }}</p>
                    @if ($comment->parent_type === 'App\Models\Article')
                    <p class="text-slate-400 italic text-[0.7rem] leading-snug">(Response to article)</p>
                    @else
                    <p class="text-slate-400 italic text-[0.7rem] leading-snug">(Response to {{ $comment->reply_to }}, {{ $comment->parent_created_at }})</p>
                    @endif
                </div>
                <div class="w-full text-slate-700">
                    {!! $comment->body !!}
                </div>
            </div>

            @auth
                <button
                    onclick="const el = document.getElementById('editor_'+{{ $comment->comment_id }}); el.classList.toggle('hidden'); el.classList.toggle('block');" 
                    class="text-rose-700 text-xs hover:text-rose-800 font-sans transition-colors delay-100 duration-250">
                    Reply to {{ $comment->comment_author }}
                </button>

                <div id="editor_{{ $comment->comment_id }}" class="hidden mt-2 origin-top animate-open-editor">
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commentable_id" value="{{ $article->id }}">
                        <input type="hidden" name="commentable_type" value="App\Models\Article">
                        <input type="hidden" name="parent_id" value="{{ $comment->comment_id }}">
                        <input type="hidden" name="parent_type" value="App\Models\Comment">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="indent_level" value="{{ $comment->indent_level + 1 }}">
        
                        <x-forms.tinymce-editor-forum/>
        
                        <button type="submit" class="py-2 px-5 mt-3 bg-rose-700 text-white  text-center rounded-md shadow-md hover:bg-rose-800 transition-colors delay-100 duration-250">Save reply</button>
                    </form>
                </div>
            @endauth
        </div>
        @empty
        <p class="my-4 text-xs font-sans">No comments</p>
        @endforelse
    </div>

    <div class="col-span-12 sm:col-span-4 row-start-3 sm:row-start-2">
        <x-sidebar :articles=$articles></x-sidebar>

        @auth
            @if (auth()->user()->is_admin() || auth()->user()->is_author())
            <div class="w-full py-2 mt-10 text-center rounded-md bg-gradient-to-b from-rose-800 via-rose-600 to-rose-800 hover:shadow-md transition-colors delay-100 duration-250">
                <a href="{{ route('articles.create') }}" class="text-rose-100 text-xs font-sans hover:text-white hover:no-underline">Add an article</a>
            </div>
            @endif 
        @endauth  
    </div>
</div>

@endsection