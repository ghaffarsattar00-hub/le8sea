<x-layout>
    @php
        // iTunes HD Image Hack
        $highResCover = str_replace('100x100bb', '600x600bb', $track['artworkUrl100']);
        $album = $track['collectionName'] ?? 'Single';
    @endphp

    <div class="relative w-full h-[50vh] bg-gray-900 overflow-hidden">
        <img src="{{ $highResCover }}" alt="{{ $track['trackName'] }}" class="w-full h-full object-cover opacity-30 blur-2xl scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-[#09090b] via-[#09090b]/80 to-transparent"></div>
    </div>

    <main class="max-w-7xl mx-auto px-6 -mt-32 relative z-10 pb-20">
        <div class="flex flex-col md:flex-row gap-10 items-center md:items-start">
            
            <div class="w-full sm:w-2/3 md:w-1/3 lg:w-1/4 flex-shrink-0">
                <img src="{{ $highResCover }}" alt="{{ $track['trackName'] }}" class="w-full rounded-3xl shadow-2xl shadow-rose-500/20 border border-white/10 hover:scale-105 transition-transform duration-300">
            </div>

            <div class="w-full md:w-2/3 lg:w-3/4 pt-4 md:pt-12 text-center md:text-left">
                <div class="inline-block border border-rose-500/30 bg-rose-500/10 rounded-full px-3 py-1 mb-4">
                    <span class="text-xs font-semibold text-rose-400 uppercase tracking-widest">{{ $track['primaryGenreName'] }}</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-2 text-white">
                    {{ $track['trackName'] }}
                </h1>
                <h2 class="text-2xl md:text-3xl font-medium text-gray-400 mb-8">
                    By <span class="text-rose-400">{{ $track['artistName'] }}</span>
                </h2>

                <div class="bg-[#18181b] p-6 rounded-2xl border border-white/10 shadow-lg max-w-xl mx-auto md:mx-0">
                    <p class="text-sm text-gray-500 mb-3 font-semibold uppercase tracking-wider">Preview Track</p>
                    <audio controls class="w-full rounded-lg" controlsList="nodownload">
                        <source src="{{ $track['previewUrl'] }}" type="audio/mp4">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
        </div>

        <div class="mt-20 border-t border-white/10 pt-16 flex flex-col lg:flex-row gap-10">
            
            <div class="w-full lg:w-2/3">
                <h2 class="text-3xl font-bold mb-8">Fan Reviews</h2>
                
                @auth
                    <form action="{{ route('reviews.store') }}" method="POST" class="bg-[#18181b] p-6 rounded-2xl border border-white/10 mb-10 shadow-lg">
                        @csrf
                        <input type="hidden" name="media_id" value="{{ $musicId }}">
                        <input type="hidden" name="media_type" value="music">
                        <textarea name="review_text" rows="3" required placeholder="What's the vibe of this track?" class="w-full bg-transparent border-0 border-b border-rose-500/50 focus:ring-0 text-white placeholder-gray-500 mb-4 outline-none resize-none"></textarea>
                        <button type="submit" class="bg-rose-500 text-black font-bold py-2.5 px-6 rounded-full hover:scale-105 transition-transform text-sm">Drop Review</button>
                    </form>
                @else
                    <div class="bg-[#18181b] p-6 rounded-2xl border border-white/10 mb-10 text-center">
                        <p class="text-gray-400 mb-3">Join the conversation</p>
                        <a href="{{ route('login') }}" class="inline-block bg-rose-500 text-black font-bold py-2 px-6 rounded-full hover:scale-105 transition-transform text-sm">Log in to Review</a>
                    </div>
                @endauth

                <div class="space-y-4">
                    @forelse($reviews as $review)
                        <div class="bg-white/5 p-5 rounded-2xl border border-white/5">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-rose-500 to-orange-500 flex items-center justify-center text-white font-bold text-lg shadow-inner">
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
                        <p class="text-gray-500 italic py-4">No reviews yet. Be the first to hype this track!</p>
                    @endforelse
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="sticky top-24 bg-gradient-to-b from-[#18181b] to-black p-6 rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-rose-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-orange-500/20 rounded-full blur-3xl"></div>
                    
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2 relative z-10">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-400">AI Verdict</span>
                        <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </h3>
                    
                    <div class="relative z-10">
                        @if($reviews->count() > 0)
                            <p class="text-gray-300 text-sm leading-relaxed mb-4">
                                {{ Cache::get('ai_verdict_music_' . $musicId, 'AI is currently analyzing the vibe of the latest reviews. Drop a new review to refresh the verdict!') }}
                            </p>
                            <div class="flex items-center gap-2 text-xs font-semibold text-rose-400 bg-rose-400/10 px-3 py-1.5 rounded-full inline-block w-max">
                                🤖 AI Generated Summary
                            </div>
                        @else
                            <p class="text-gray-500 text-sm leading-relaxed italic">
                                Not enough reviews yet for the AI to analyze the vibe. Drop the first review!
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
