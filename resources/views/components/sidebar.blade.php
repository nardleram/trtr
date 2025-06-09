@php
    use App\Models\Article;

    $count = 0;
    $latest = $articles->sortByDesc('created_at')->take(5);
    $most_commented = Article::most_commented();
@endphp

{{-- Sidebar --}}
<div class="mb-5">
    <div class="p-2 mb-2 bg-white rounded-md border border-slate-200">
        <h4 class="mb-2 text-sm font-semibold tracking-tight text-dBlue">Categories</h4>
        <div class="flex flex-wrap gap-1">
            <form action="{{ route('articles.consciousness') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="consciousness">
                <button type="submit" class="px-2 py-1 text-xs bg-sky-100 rounded-md transition-colors delay-100 hover:text-white hover:bg-sky-500 duration-250">consciousness</button>
            </form>

            <form action="{{ route('articles.love') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="love">
                <button type="submit" class="px-2 py-1 text-xs bg-emerald-100 rounded-md transition-colors delay-100 hover:text-white hover:bg-emerald-600 duration-250">love–wisdom–health</button>
            </form>

            <form action="{{ route('articles.group') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="group dynamics">
                <button type="submit" class="px-2 py-1 text-xs bg-violet-200 rounded-md transition-colors delay-100 hover:text-white hover:bg-violet-600 duration-250">group dynamics</button>
            </form>

            <form action="{{ route('articles.money') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="money">
                <button type="submit" class="px-2 py-1 text-xs bg-amber-200 rounded-md transition-colors delay-100 hover:text-white hover:bg-amber-600 duration-250">money</button>
            </form>

            <form action="{{ route('articles.politics') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="politics & geopolitics">
                <button type="submit" class="px-2 py-1 text-xs bg-pink-200 rounded-md transition-colors delay-100 hover:text-white hover:bg-pink-700 duration-250">politics & geopolitics</button>
            </form>
        </div>
    </div>

    <div class="p-2 mb-2 bg-white rounded-md border border-slate-200">
        <h4 class="mb-2 font-sans text-sm font-semibold tracking-tight text-dBlue">Latest articles</h4>
        @forelse ($latest as $article)
        <a href="{{ route('articles.show', $article->slug) }}">
            <p class="text-xs text-slate-400 font-medium font-sans">{{ $article->title }}</p>
        </a>
        @empty
        <p class="text-xs font-light text-textBase">No articles yet</p>
        @endforelse
    </div>

    <div class="p-2 mb-2 bg-white rounded-md border border-slate-200">
        <h4 class="mb-2 font-sans text-sm font-semibold tracking-tight text-dBlue">Most commented articles</h4>
        @foreach ($most_commented as $commented_article)
            @if ($commented_article->comments_count > 0)
                @php
                    $count++;
                @endphp
                <a href="{{ route('articles.show', $commented_article->slug) }}">
                    <p class="text-xs text-slate-400 font-medium font-sans">{{ $commented_article->title }}</p>
                </a>
            @endif
        @endforeach
        @if (!$count)
        <p class="text-xs font-light text-textBase">No articles to display</p>
        @endif
    </div>
</div>

<div class="relative p-2 my-4 w-full text-sm text-center text-white bg-gradient-to-b rounded-md transition-shadow delay-100 from-dBlue via-primaryBlue to-dBlue hover:shadow-md duration-250">
    <div onclick="copyAddress('doge')" class="absolute top-2 right-2 w-4 h-4 text-cyan-100 transition-colors delay-100 cursor-pointer hover:text-white duration-250">
        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
          </svg>
    </div>

    <div class="flex flex-nowrap gap-0 items-center mx-auto mb-1 w-fit">
        <p class="mr-2 text-xs font-semibold">
            Say “Danke!” with Doge
        </p>
        <svg width="22px" height="22px" viewBox="0 0 36 36" class="-mt-1" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" fill-rule="evenodd">
                <circle cx="16" cy="16" r="16" fill="#C3A634"/>
                <path fill="#FFF" d="M13.248 14.61h4.314v2.286h-4.314v4.818h2.721c1.077 0 1.958-.145 2.644-.437.686-.291 1.224-.694 1.615-1.21a4.4 4.4 0 00.796-1.815 11.4 11.4 0 00.21-2.252 11.4 11.4 0 00-.21-2.252 4.396 4.396 0 00-.796-1.815c-.391-.516-.93-.919-1.615-1.21-.686-.292-1.567-.437-2.644-.437h-2.721v4.325zm-2.766 2.286H9v-2.285h1.482V8h6.549c1.21 0 2.257.21 3.142.627.885.419 1.607.99 2.168 1.715.56.724.977 1.572 1.25 2.543.273.971.409 2.01.409 3.115a11.47 11.47 0 01-.41 3.115c-.272.97-.689 1.819-1.25 2.543-.56.725-1.282 1.296-2.167 1.715-.885.418-1.933.627-3.142.627h-6.549v-7.104z"/>
            </g>
        </svg>
    </div>
    
    <div class="-mt-1.5 w-full">
        <input type="text" id="doge_wallet" value="D5yi7NuZDQv47tnFgeKMLE1KKUhavs67ud" class="overflow-scroll p-0 w-full text-xs font-light text-center text-cyan-200 bg-transparent border-none ring-0 transition-colors delay-100 hover:text-white focus:border-none duration-250">
    </div>
</div>

<div class="relative p-2 my-4 w-full text-sm text-center text-white bg-gradient-to-b rounded-md transition-shadow delay-100 from-dBlue via-primaryBlue to-dBlue hover:shadow-md duration-250">
    <div onclick="copyAddress('ltc')" class="absolute top-2 right-2 w-4 h-4 text-cyan-100 transition-colors delay-100 cursor-pointer hover:text-white duration-250">
        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
          </svg>
    </div>

    <div class="flex flex-nowrap gap-0 items-center mx-auto mb-1 w-fit">
        <p class="mr-2 text-xs font-semibold">
            Slip me some LTC
        </p>
        <svg width="18px" height="18px" id="Layer_1" class="-mt-2" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 82.6 82.6">
            <title>
                litecoin-ltc-logo
            </title>
            <circle cx="41.3" cy="41.3" r="36.83" style="fill:#fff"/>
            <path d="M41.3,0A41.3,41.3,0,1,0,82.6,41.3h0A41.18,41.18,0,0,0,41.54,0ZM42,42.7,37.7,57.2h23a1.16,1.16,0,0,1,1.2,1.12v.38l-2,6.9a1.49,1.49,0,0,1-1.5,1.1H23.2l5.9-20.1-6.6,2L24,44l6.6-2,8.3-28.2a1.51,1.51,0,0,1,1.5-1.1h8.9a1.16,1.16,0,0,1,1.2,1.12v.38L43.5,38l6.6-2-1.4,4.8Z" style="fill:#345d9d"/>
        </svg>
    </div>
    
    <div class="-mt-1.5 w-full">
        <input type="text" id="ltc_wallet" value="LfCevcxsbeUZb2Y8ScudQLKm7HVnCzTkXy" class="overflow-scroll p-0 w-full text-xs font-light text-center text-cyan-200 bg-transparent border-none ring-0 transition-colors delay-100 hover:text-white focus:border-none duration-250">
    </div>
</div>

<div class="relative p-2 my-4 w-full text-sm text-center text-white bg-gradient-to-b rounded-md transition-shadow delay-100 from-dBlue via-primaryBlue to-dBlue hover:shadow-md duration-250">
    <div onclick="copyAddress('xmr')" class="absolute top-2 right-2 w-4 h-4 text-cyan-100 transition-colors delay-100 cursor-pointer hover:text-white duration-250">
        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
          </svg>
    </div>

    <div class="flex flex-nowrap gap-0 items-center mx-auto mb-1 w-fit">
        <p class="mr-2 text-xs font-semibold">
            Move me with Monero
        </p>
        <svg width="18px" height="18px" class="-mt-2" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3756.09 3756.49">
            <title>monero</title>
            <path d="M4128,2249.81C4128,3287,3287.26,4127.86,2250,4127.86S372,3287,372,2249.81,1212.76,371.75,2250,371.75,4128,1212.54,4128,2249.81Z" transform="translate(-371.96 -371.75)" style="fill:#fff"/><path id="_149931032" data-name=" 149931032" d="M2250,371.75c-1036.89,0-1879.12,842.06-1877.8,1878,0.26,207.26,33.31,406.63,95.34,593.12h561.88V1263L2250,2483.57,3470.52,1263v1579.9h562c62.12-186.48,95-385.85,95.37-593.12C4129.66,1212.76,3287,372,2250,372Z" transform="translate(-371.96 -371.75)" style="fill:#f26822"/><path id="_149931160" data-name=" 149931160" d="M1969.3,2764.17l-532.67-532.7v994.14H1029.38l-384.29.07c329.63,540.8,925.35,902.56,1604.91,902.56S3525.31,3766.4,3855,3225.6H3063.25V2231.47l-532.7,532.7-280.61,280.61-280.62-280.61h0Z" transform="translate(-371.96 -371.75)" style="fill:#4d4d4d"/>
        </svg>
    </div>
    
    <div class="-mt-1.5 w-full">
        <input type="text" id="ltc_wallet" value="42WBLZJoGC7BrC6eGShjZsAWhuqx95arW4Q26SaHXvtA1C8hhArw2EuGYEA9yRiBXwcYDdQCv74CUNby3dzBQYEzPgwgnWv" class="overflow-scroll p-0 w-full text-xs font-light text-center text-cyan-200 bg-transparent border-none ring-0 transition-colors delay-100 hover:text-white focus:border-none duration-250">
    </div>
</div>



<script defer>
    function copyAddress(id) {
        // Get the text field
        var copyText = document.getElementById(id+'_wallet');

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }
</script>