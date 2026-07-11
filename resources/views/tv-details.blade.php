<x-layout>
    <div class="relative w-full h-[60vh] bg-gray-900">
        @if(isset($show['backdrop_path']))
            <img src="https://image.tmdb.org/t/p/original{{ $show['backdrop_path'] }}" alt="{{ $show['name'] }}" class="w-full h-full object-cover opacity-40">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#09090b] via-[#09090b]/60 to-transparent"></div>
    </div>

    <main class="max-w-7xl mx-auto px-6 -mt-32 relative z-10 pb-20">
        <div class="flex flex-col md:flex-row gap-10">
            
            <div class="w-full md:w-1/3 lg:w-1/4 flex-shrink-0">
                @if(isset($show['poster_path']))
                    <img src="https://image.tmdb.org/t/p/w500{{ $show['poster_path'] }}" alt="{{ $show['name'] }}" class="w-full rounded-2xl shadow-2xl border border-white/10 hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full aspect-[2/3] bg-gray-800 rounded-2xl flex items-center justify-center border border-white/10">No Poster</div>
                @endif
            </div>

            <div class="w-full md:w-2/3 lg:w-3/4 pt-4 md:pt-12">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-2">
                    {{ $show['name'] }}
                    <span class="text-2xl md:text-4xl text-gray-500 font-normal">
                        ({{ isset($show['first_air_date']) ? \Carbon\Carbon::parse($show['first_air_date'])->format('Y') : 'N/A' }})
                    </span>
                </h1>

                @if(isset($show['tagline']) && $show['tagline'])
                    <p class="text-xl text-cyan-400 italic mb-6">"{{ $show['tagline'] }}"</p>
                @endif

                <div class="flex items-center gap-6 mb-8 text-sm md:text-base">
                    <div class="flex items-center gap-2 bg-yellow-500/10 text-yellow-400 px-4 py-2 rounded-full border border-yellow-500/20 font-bold">
                        <span>★</span> {{ number_format($show['vote_average'], 1) }} / 10
                    </div>
                    <div class="text-gray-400 font-medium">
                        {{ $show['number_of_seasons'] }} Seasons • {{ $show['number_of_episodes'] }} Episodes
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($show['genres'] as $genre)
                            <span class="bg-white/5 border border-white/10 px-3 py-1 rounded-full text-gray-300">{{ $genre['name'] }}</span>
                        @endforeach
                    </div>
                </div>

                <h3 class="text-2xl font-bold mb-3">Overview</h3>
                <p class="text-gray-400 text-lg leading-relaxed max-w-4xl mb-10">
                    {{ $show['overview'] }}
                </p>
                
                @if(isset($show['created_by']) && count($show['created_by']) > 0)
                <div class="mb-10">
                    <h3 class="text-xl font-bold mb-2">Created By</h3>
                    <div class="flex gap-4 flex-wrap">
                        @foreach($show['created_by'] as $creator)
                            <span class="bg-white/10 px-4 py-2 rounded-lg text-gray-300">{{ $creator['name'] }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>

        <div class="mt-20 border-t border-white/10 pt-16 flex flex-col lg:flex-row gap-10">
            
            <div class="w-full lg:w-2/3">
                <h2 class="text-3xl font-bold mb-8">Series Reviews</h2>
                
                @auth
                    <form action="{{ route('reviews.store') }}" method="POST" class="bg-[#18181b] p-6 rounded-2xl border border-white/10 mb-10 shadow-lg">
                    @csrf
                    <input type="hidden" name="media_id" value="{{ $show['id'] }}">
                    <input type="hidden" name="media_type" value="tv">
                    <textarea name="review_text" rows="3" required placeholder="What are your thoughts on this series?" class="w-full bg-transparent border-0 border-b border-white/20 focus:ring-0 text-white placeholder-gray-500 mb-4 outline-none resize-none"></textarea>
                    <button type="submit" class="bg-white text-black font-bold py-2.5 px-6 rounded-full hover:scale-105 transition-transform text-sm">Post Review</button>
                </form>
                @else
                    <div class="bg-[#18181b] p-6 rounded-2xl border border-white/10 mb-10 text-center">
                        <p class="text-gray-400 mb-3">Join the conversation</p>
                        <a href="{{ route('login') }}" class="inline-block bg-white text-black font-bold py-2 px-6 rounded-full hover:scale-105 transition-transform text-sm">Log in to Review</a>
                    </div>
                @endauth

                <div class="space-y-4">
                    @forelse($reviews as $review)
                        <div class="bg-white/5 p-5 rounded-2xl border border-white/5">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-purple-500 to-cyan-500 flex items-center justify-center text-white font-bold text-lg shadow-inner">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-200">{{ $review->user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-gray-300 leading-relaxed">{{ $review->review_text }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 italic py-4">No reviews yet. Be the first to share your thoughts!</p>
                    @endforelse
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="sticky top-24 bg-gradient-to-b from-[#18181b] to-black p-6 rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-purple-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-cyan-500/20 rounded-full blur-3xl"></div>
                    
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2 relative z-10">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">AI Verdict</span>
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </h3>
                    
                    <div class="relative z-10">
                        @if($reviews->count() >= 3)
                            <p class="text-gray-300 text-sm leading-relaxed mb-4">
                                {{ $aiVerdict }}
                            </p>
                            <div class="flex items-center gap-2 text-xs font-semibold text-cyan-400 bg-cyan-400/10 px-3 py-1.5 rounded-full inline-block">
                                🤖 AI Generated Summary
                            </div>
                        @else
                            <p class="text-gray-500 text-sm leading-relaxed italic">
                                Not enough reviews yet for the AI to generate a verdict. We need at least 3 reviews to synthesize an opinion!
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-layout>