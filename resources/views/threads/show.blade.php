@extends('layouts.mainLayout')

@section('content')

<div class="mt-[88px] sm:mt-[140px] md:mt-52">
    <div class="m-auto w-full px-3 sm:p-0 sm:w-4/5 md:px-5 lg:w-2/3">
        <div class="mb-12">
            <h1 class="text-sm font-semibold mb-4">{{ $thread[0]->title }}</h1>
            <p class="text-base font-serif mb-4">{{ $thread[0]->description }}</p>
            <p class="italic text-xs text-dBlue">{{ $thread[0]->name }}, {{ $thread[0]->created_at->format('j M y, H:i') }}</p>
        </div>

        @error($errors)
        @enderror

        @auth
            <h4 class="mb-2 text-xl font-semibold">Respond to thread</h4>

            <div class="w-full sm:w-[95%] mb-8">
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_id" value="{{ $thread[0]->id }}">
                    <input type="hidden" name="commentable_type" value="App\Models\Thread">
                    <input type="hidden" name="parent_id" value="{{ $thread[0]->id }}">
                    <input type="hidden" name="parent_type" value="App\Models\Thread">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="indent_level" value="{{ 0 }}">

                    <x-forms.tinymce-editor-forum/>

                    <button type="submit" class="py-2 px-5 mt-3 bg-rose-700 text-white  text-center rounded-md shadow-md hover:bg-rose-800 transition-colors delay-100 duration-250">Save response</button>
                </form>
            </div>
        @endauth

        <div class="flex items-center justify-between mb-2">
            @if ($thread->comments->count() > 0)
                <h4 class="text-sm font-semibold mr-2">Comments</h4>
            @endif

            @guest
                <a href="{{ route('login') }}" class="text-dBlue text-xs hover:text-primaryBlue transition-colors delay-100 duration-250">
                    Log in to join the conversation
                </a>
            @endguest
        </div>

        @forelse ($thread->comments as $comment)
            <div class="mb-5 p-indent-{{ $comment->indent_level > 2 ? 2 : $comment->indent_level }} md:p-indent-{{ $comment->indent_level }}">
                <div class="flex flex-col md:flex-row border-t border-t-slate-200 pt-2 mb-2">
                    <div class="flex flex-row md:block md:flex-none w-full md:w-1/4 md:mr-2 mb-2 md:mb-0">
                        <p class="text-dBlue italic text-xs mb-1 mr-1 md:mr-0">{{ $comment->comment_author }}</p>
                        <p class="text-dBlue italic text-xs mb-1 mr-1 md:mr-0">{{ $comment->created_at->format('j M y, H:i') }}</p>
                        @if ($comment->parent_type === 'App\Models\Thread')
                        <p class="text-slate-400 italic text-xs leading-relaxed">(Response to main thread)</p>
                        @else
                        <p class="text-slate-400 italic text-xs leading-relaxed">(Reply to {{ $comment->reply_to }}, {{ $comment->parent_created_at }})</p>
                        @endif
                    </div>
                    <div class="w-full md:w-3/4">
                        <p class="text-sm font-light">{!! $comment->body !!}</p>
                    </div>
                </div>

                @auth
                    <button
                        onclick="const el = document.getElementById('editor_'+{{ $comment->comment_id }}); el.classList.toggle('hidden'); el.classList.toggle('block');" 
                        class="text-rose-700 text-sm hover:text-rose-800 transition-colors delay-100 duration-250">
                        Reply to {{ $comment->comment_author }}
                    </button>

                    <div id="editor_{{ $comment->comment_id }}" class="hidden mt-2 origin-top animate-open-editor">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $thread[0]->id }}">
                            <input type="hidden" name="commentable_type" value="App\Models\Thread">
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
            <p class="mt-5">No comments</p>
        @endforelse
    </div>
</div>

@endsection