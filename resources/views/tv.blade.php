<x-layout>
    <main class="pb-16 px-6 pt-32">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <div class="inline-block border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                <span class="text-xs font-semibold text-purple-400 uppercase tracking-widest">
                    Series & Shows
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Binge-worthy <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">TV Series.</span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                From mind-bending sci-fi to gritty crime thrillers. See what everyone is watching this week.
            </p>
        </div>

        <section class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                Trending Series <span class="text-xl">📺</span>
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($trendingTv as $show)
                <a href="/tv/{{ $show['id'] }}" class="group cursor-pointer block">
                    <div class="relative overflow-hidden rounded-2xl aspect-[2/3] bg-gray-800">
                        <img src="https://image.tmdb.org/t/p/w500{{ $show['poster_path'] }}" alt="{{ $show['name'] }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500 opacity-80 group-hover:opacity-100">
                        <div class="absolute bottom-0 w-full bg-gradient-to-t from-black via-black/80 to-transparent p-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm font-bold mb-1">
                                ★ {{ number_format($show['vote_average'], 1) }}
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 font-semibold text-lg truncate">{{ $show['name'] }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ isset($show['first_air_date']) ? \Carbon\Carbon::parse($show['first_air_date'])->format('Y') : 'N/A' }} • TV Series
                    </p>
                </a>
                @endforeach
            </div>
        </section>
    </main>
</x-layout>