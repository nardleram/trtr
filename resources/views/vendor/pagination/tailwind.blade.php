@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex w-full justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative w-36 inline-flex items-center px-4 py-2 text-xs text-dBlue bg-white border border-slate-300 cursor-default leading-5 rounded-md dark:text-primaryBlue dark:bg-slate-800 dark:border-slate-dBlue">
                    <p class="text-xs">
                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
                        </svg>
                        Go back
                    </p>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative w-40 inline-flex items-center px-4 py-2 text-xs text-dBlue bg-white border border-slate-300 leading-5 rounded-md hover:text-primaryBlue hover:no-underline focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-slate-100 active:text-dBlue transition ease-in-out duration-150 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-300 dark:focus:border-blue-700 dark:active:bg-slate-700 dark:active:text-slate-300">
                    <p class="text-xs">
                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
                        </svg>
                        Go back
                    </p>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative w-40 inline-flex items-center px-4 py-2 ml-3 text-xs text-dBlue bg-white font-sans border border-slate-300 leading-5 rounded-md hover:text-primaryBlue hover:no-underline focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-slate-100 active:text-dBlue transition ease-in-out duration-150 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-300 dark:focus:border-blue-700 dark:active:bg-slate-700 dark:active:text-slate-300">
                    <p class="text-xs">
                        Go on
                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
                        </svg>
                    </p>
                </a>
            @else
                <span class="relative w-40 inline-flex items-center px-4 py-2 ml-3 text-xs font-medium text-primaryBlue bg-white border border-slate-300 cursor-default leading-5 rounded-md dark:text-slate-600 dark:bg-slate-800 dark:border-slate-600">
                    <p class="text-xs">
                        Go on
                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
                        </svg>
                    </p>
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-xs text-dBlue leading-5 dark:text-dBlue">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-xs font-medium text-primaryBlue bg-white border border-slate-300 cursor-default rounded-l-md leading-5 dark:bg-slate-800 dark:border-slate-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-xs text-primaryBlue font-sans bg-white border border-slate-300 rounded-l-md leading-5 hover:text-white focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-slate-100 active:text-primaryBlue transition ease-in-out duration-150 dark:bg-slate-800 dark:border-slate-600 dark:active:bg-slate-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-xs font-sans font-medium text-dBlue bg-white border border-slate-300 cursor-default leading-5 dark:bg-slate-800 dark:border-slate-600">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-xs font-medium text-primaryBlue bg-white border border-slate-300 cursor-default leading-5 dark:bg-slate-800 dark:border-slate-600">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-xs font-medium text-dBlue font-sans bg-white border border-slate-300 leading-5 hover:text-primaryBlue hover:no-underline focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-slate-100 active:text-dBlue transition ease-in-out duration-150 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-400 dark:hover:text-white dark:active:bg-slate-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-xs font-sans font-medium text-primaryBlue bg-white border border-slate-300 rounded-r-md leading-5 hover:text-white hover:no-underline focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-slate-100 active:text-primaryBlue transition ease-in-out duration-150 dark:bg-slate-800 dark:border-slate-600 dark:active:bg-slate-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-xs font-medium text-primaryBlue bg-white border border-slate-300 cursor-default rounded-r-md leading-5 dark:bg-slate-800 dark:border-slate-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
