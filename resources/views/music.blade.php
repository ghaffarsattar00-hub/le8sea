<x-layout>
    <main class="pb-16 px-6 pt-32">
        <div class="max-w-4xl mx-auto text-center mb-10">
            <div class="inline-block border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                <span class="text-xs font-semibold text-rose-400 uppercase tracking-widest">
                    Vibes & Audio
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Feel The <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-400">Rhythm.</span>
            </h1>
            
            <form action="{{ route('music.search') }}" method="GET" class="max-w-xl mx-auto mt-8 relative">
                <input type="text" name="query" value="{{ $searchQuery ?? '' }}" placeholder="Search songs, artists, albums..." required class="w-full bg-[#18181b] text-white px-6 py-4 rounded-full text-base border border-white/10 focus:outline-none focus:border-rose-500 transition-all placeholder-gray-500 shadow-lg">
                <button type="submit" class="absolute right-2 top-2 bottom-2 bg-rose-500 text-black font-bold px-8 rounded-full hover:scale-105 transition-transform">
                    Search
                </button>
            </form>
        </div>

        <section class="max-w-7xl mx-auto mt-16">
            @if(isset($searchQuery))
                <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                    Results for <span class="text-rose-400">"{{ $searchQuery }}"</span> 🎵
                </h2>
            @else
                <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                    Trending Tracks <span class="text-xl">🔥</span>
                </h2>
            @endif
            
            @if(count($tracks) > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($tracks as $track)
                    @php
                        // iTunes ki choti image ko HD quality mein convert karna
                        $highResImage = str_replace('100x100bb', '300x300bb', $track['artworkUrl100']);
                    @endphp

                    <a href="/music/{{ $track['trackId'] }}" class="group cursor-pointer block bg-[#18181b] rounded-2xl p-4 border border-white/5 hover:border-rose-500/50 transition-colors">
                        <div class="relative overflow-hidden rounded-xl aspect-square bg-gray-800 mb-4 shadow-lg shadow-black/50">
                            <img src="{{ $highResImage }}" alt="{{ $track['trackName'] }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                            
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="bg-rose-500 rounded-full p-3 text-black">
                                    <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6V4z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="font-bold text-base truncate text-gray-100" title="{{ $track['trackName'] }}">{{ $track['trackName'] }}</h3>
                        <p class="text-sm text-gray-400 truncate mt-1">
                            {{ $track['artistName'] }}
                        </p>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="bg-[#18181b] p-16 rounded-2xl border border-white/10 text-center shadow-lg mt-8">
                    <div class="text-5xl mb-4">🎧</div>
                    <p class="text-gray-400 text-lg mb-6">No tracks found matching "<span class="text-white">{{ $searchQuery }}</span>".</p>
                    <a href="{{ route('music.index') }}" class="inline-block bg-white text-black font-bold py-2.5 px-6 rounded-full hover:scale-105 transition-transform text-sm">Back to Hits</a>
                </div>
            @endif
        </section>
    </main>
</x-layout>