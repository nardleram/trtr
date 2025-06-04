@extends('layouts.mainLayout')

@section('content')

@if ($success)
    <div class="absolute top-[115px] sm:top-[135px] md:top-56 w-32 py-2 border border-rose-700 rounded-md shadow-md mx-auto z-50">
        <p class="text-textBase">{{ $success }}</p>
    </div>
@endif

<div class="mx-auto w-11/12 sm:w-4/5 grid gap-24 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-between items-center mt-[135px] sm:mt-[185px] md:mt-56">
    <div class="mx-auto w-3/4 md:w-full">
        <img src="storage/images/wealthyMoon.svg" alt="all money to the moon" class="rounded-md shadow-md">
    </div>
    <div class="mx-auto w-3/4 md:w-full">
        <img src="storage/images/brainConsciousness.svg" alt="if consciousness is an illusion...">
    </div>
    <div class="mx-auto w-3/4 md:w-full">
        <img src="storage/images/noWayToPeace.svg" alt="Thich Nhat Hanh quote" class="rounded-md shadow-md">
    </div>
    <div class="mx-auto w-3/4 md:w-full">
        <img src="storage/images/nothingEverGoesAway.svg" alt="Pema Chodron quote">
    </div>
    <div class="mx-auto w-3/4 md:w-full">
        <img src="storage/images/loveThineEnemies.svg" alt="love thine enemies" class="rounded-md shadow-md">
    </div>
    <div class="mx-auto w-3/4 md:w-full">
        <img src="storage/images/LoveIs.svg" alt="love is unconditional" width="100%" height="auto">
    </div>
</div>

<div class="px-8 py-6 mt-16 sm:px-10 sm:py-8 md:px-24 md:py-10 lg:px-56 text-justify bg-slate-800">
    <p class="text-[0.95rem] font-light leading-10 text-white">The Truth Transparent logo implies a process: a complex of vectors caught between confusion and clarity. Something concealed is being revealed. The site’s content is the written expression of this process. Just as science pulls itself higher on the finger- and toe-holds provided by theory, so theory is adapted by experimentation, deduction and verification back into more refined theory, so the Western world transitions from materialism to what follows. Science itself is not at stake; the meta-theory that still dominates Western thought now faces its demise.</p>
</div>

<div class="px-8 pt-6 mb-8 sm:px-10 sm:pt-8 md:px-24 md:pt-10 lg:px-56 text-justify">
    <p class="text-[0.95rem] font-light leading-10">This is not a philosophy site, nor is it focussed on economics. It simply adopts a common-sense approach to the fundamentals in interesting times. Truth Transparent attempts to flesh out, in some detail, a pragmatics of love as guided by the author’s knowing; <em>there is only God</em>. As materialism crumbles, as the undergirding structure of our ethics and our law, our economics and our politics crumbles with it, Truth Transparent highlights the questions that humanity – particularly in the Western tradition – should address as it struggles with its epochal transformation.</p>
</div>

@endsection