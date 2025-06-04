@extends('layouts.mainLayout')

@section('content')

@if ($success)
    <div class="absolute top-[115px] sm:top-[135px] md:top-56 w-32 py-2 border border-rose-700 rounded-md shadow-md mx-auto z-50">
        <p class="text-textBase">{{ $success }}</p>
    </div>
@endif

<div class="max-w-[920px] min-w-[50px] mx-auto grid grid-cols-12 gap-3 sm:gap-4 md:gap-6 mt-[135px] sm:mt-[155px] md:mt-[220px] px-2 sm:px-4 md:px-6">
    <div class="row-start-1 col-span-12">
        <h1 class="font-sans text-base font-semibold">An unordered tour of my biases</h1>
    </div>

    <div class="col-span-12 sm:col-span-8 items-start justify-items-start font-serif leading-6 pr-3">
        <p class="mb-3 text-base">My basic outlook is <span class="font-bold">anarchistic</span>; only an anarchistic mindset among a given population can properly embed <span class="font-bold">an enduring commitment to freedom of speech</span>. Without this deep commitment, society tends to drift towards totalising power accumulations that can, over time, only corrupt. Corruption – at the scale of nation states and multinational blocs/corporations – repeatedly leads to unspeakable mass violence and tragedy. Flowing directly from this, I am <span class="font-bold">strongly pro-science as a methodology for fostering intellectual humility</span>, and consequently strongly opppose scientism.</p>

        <p class="mb-3 text-base">I am also profoundly <span class="font-bold">Christian</span> in my sensibilities, though not a Christian <em>per se</em>. One aspect of this is that <span class="font-bold">I respect hierarchical orderings that are rooted in natural authority</span>. In my particular case, this yields an approach to life that is a patchily evolving attempt to <span class="font-bold">love my enemies</span> and be <span class="font-bold">meek</span> in my relationships with everything around me. This is the opposite of weak passivity. It takes courage and perseverance to do this well – which means <em>healthily</em>. To speak truth to power effectively, in a manner that has a good chance of moving things in a <em>healthier</em> direction, one should speak it <em>lovingly</em> and humbly, i.e. <em>wisely</em>.</p>

        <p class="mb-3 text-base">In other words, I do not see <span class="font-bold">anarchy and hierarchy</span> as mutually exclusive. To my mind they <span class="font-bold">are mutually enriching</span>. Similarly, I adhere to neither the political left nor the right. I see them too as mutually enriching perspectives. Nor do I see myself as a capitalist, an anarchist, a socialist or any other -ist. <span class="font-bold">I see no lasting value in being loyal to an ideology</span>.</p>

        <p class="mb-3 text-base">My education took me to Masters level. However, the articles I publish here are not academically rigorous works. They are <span class="font-bold">maverick musings</span> that I hope are logically coherent and thus somewhat persuasive, and, with luck, positively provocative. My musings also range far from the territory of my academic training (philosophy and translation theory), and as such are <span class="font-bold">autodidactic</span>. Hence – and for many other reasons – it is not my place to prescribe solutions, nor in fact do I have much faith in prescriptions generally; wisdom is best left to evolve organically from within; it is richly unique from creature to creature. The more we honour this simple fact, the better.</p>

        <p class="mb-3 text-base"><span class="font-bold">I am not a materialist</span>. In truth, I don’t know what I am as a specific philosophical term or tradition – some flavour of idealist no doubt. As far as I can tell, my ontological position is very close to those advanced by e.g. David Bentley Hart, Charles Eisenstein, Darren Allen and Iain McGilchrist. For me, <span class="font-bold">there is nothing but God</span>. Reality is life. Life is a meaning-creating patterning, or process, that endlessly evolves itself into ever more elegant complexity as a function of its inexaustible curiousity and creativity. I understand ‘matter’ – physical existence – as a manifestation of the laws of physics, where laws are creatures of information, and where information is a creature of consciousness. In other words, laws as <em>rules</em> that govern the foundational behaviours of our physical reality: its chemistry, biology, psychology, etc. But all of it <em>of consciousness</em>. I envisage this as being akin to the way computer code <em>rules</em> the behaviour of the software it generates, where the software is an interface used by consciousness to make free-will choices it then learns from in pursuit of the evolution of its <em>wisdom</em> and <em>love</em>, a process I equate with <em>health</em>. Donald Hoffman, Bernado Kastrup and Thomas Campbell are my main influences for the meat and potatoes of this part of my evolving ontological position.</p>

        <p class="mb-3 text-base">Why is my ontology relevant here? Because ethics and morality have a very different flavour and basis as creatures of soul/consciousness, than they do as creatures of biochemistry. Materialism/physicalism asserts a dead, mechanistic universe. In it, ethics and morality are incongruous artefacts of a brain-based experience of pain and anguish. In materialism’s purview, we are asked to manage suffering as if it were sand in a machine, an irritant that negatively impacts efficiency and productivity. If you see reality as fundamentally dead, you are doomed to underestimate life in all its creative beauty. This ideological underestimation produces the cynical, pathological world we see around us, especially in the West and in westernised nations. As if that weren’t soul destroying enough, materialism also sees love, humility, wisdom, etc. as quasi-illusory artefacts of the brain’s biochemistry. I see them as ontological fundamentals. We should, therefore, organise ourselves and our societies around these fundamentals in the first instance, then subordinately attend to the politics of governance and civics, I dearly hope without party politics and ideology … some day very soon.</p>

        <p class="mb-3 text-base"><span class="font-bold">Truth Transparent</span> is dedicated to fleshing out the above sketch, to make it seem both reasonable and attractive. Its gathered articles are best understood as a book, one that, <em>hopefully</em>, always evolves in quality.</p>

        <h1 class="font-sans text-sm font-semibold mt-8 mb-4">A little about me (Toby Russell)</h1>

        <img src="/storage/images/me.jpeg" alt="porttrait of the author as a younger man" class="mx-2 mt-2 h-[135px] rounded-full float-right">

        <p class="mb-3 text-base">Born in 1966, I am no longer young. And though born in the UK, I no longer see myself as British; I have travelled too much, lived abroad for too long, and married too deeply into a German-Philippino family. My career is a slipshod patchwork of writing, music, desktop publishing, Unix/Linux systems administration, translation, and web-software programming. Frankly, I’m lucky to still be housed, domesticated, and considered a husband. O the weirdness of me!</p>

        <p class="mb-3 text-base">In other words, I’ve been around. And continue to be so.</p>

        <p class="mb-3 text-base">On 28 April, 2025, I will have been married for thirty years, so I know plenty about partnership and domesticity. My wife and I currently live in Leeds with four cats. Together, and especially in the mornings, they are Catnami. A catnami is like a tsunami, only far more regular (though not quite as wet).</p>

        <p class="mb-3 text-base">Somewhere in my twenties, I realised I know that God is. The realisation was a deep acceptance of what I am. I had indecisively fluctuated between athiesm, faith and agnosticism up until that point. A little while later, I realised that there is only God. This, for me, accommodates the problem of suffering. It’s built in. We are not puppets. We learn to live as humans, and that includes the blessing-curse of learning grace under pressure. In our curiously human wisdom and sparkling human cleverness, we have done the most terrible things to each other, but also co-created great beauty. This is because there is only God.</p>

        <p class="mb-3 text-base">Scattered across my forties, a series of physical miracles were visited on me and my wife. I have no idea why, but have been trying to make sense of them ever since. This website – and the second chronological half of <a href="https://thdrussell.blogspot.com/">my old blog</a> – are testament to this attempt. I will not detail these events; I cannot replicate what happened to us, and there is no way of proving the veracity of any account I might give. I also do not want what I write to be about those miracles. They happened unbidden, and proved to me beyond all doubt that materialism is ontologically fallacious and that there is nothing but God. This is the totality of my disclosure on this matter. Beyond this, I will not mention the miracles again.</p>

        <p class="mb-3 text-base">How all this pans out in detail – the demise of materialism, the demise of the current iteration of the West, the fallout of the digital or information age, etc. – is a work for us all, an exciting and daunting work that I contribute to with my very humble abilities.</p>
        
        <p class="mb-5 text-base">It’s something of a compulsion.</p>

        <p class="mb-8 text-xs font-sans">17 March, 2025</p>
    </div>

    <div class="col-span-12 sm:col-span-4">
        <x-sidebar :articles=$articles></x-sidebar>
      
    </div>
</div>

@endsection