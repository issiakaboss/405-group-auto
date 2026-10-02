<main class="min-h-screen bg-slate-50">
    <header class="border-b border-slate-800 bg-slate-950 px-4 py-12 text-white sm:py-16">
        <div class="mx-auto max-w-4xl">
            <p class="mb-3 text-xs font-bold uppercase tracking-[0.16em] text-amber-400">405 AUTO GROUP LLC</p>
            <h1 class="text-3xl font-extrabold leading-tight sm:text-4xl">{{ $document['title'] }}</h1>
            <p class="mt-4 text-sm text-slate-400">{{ $document['updated'] }}</p>
        </div>
    </header>

    <article class="mx-auto max-w-4xl space-y-10 px-4 py-10 text-sm leading-7 text-slate-600 sm:px-6 sm:py-14">
        <section class="space-y-3">
            <h2 class="text-lg font-bold text-slate-900">{{ $document['introduction_title'] }}</h2>
            <p>{{ $document['introduction'] }}</p>
        </section>

        @foreach($document['sections'] as $section)
        <section class="space-y-3 border-t border-slate-200 pt-7">
            <h2 class="text-lg font-bold text-slate-900">{{ $section['title'] }}</h2>
            @foreach($section['paragraphs'] ?? [] as $paragraph)
            <p>{{ $paragraph }}</p>
            @endforeach
            @if(! empty($section['items']))
            <ul class="list-disc space-y-2 pl-5 marker:text-amber-500">
                @foreach($section['items'] as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
            @endif
        </section>
        @endforeach
    </article>
</main>