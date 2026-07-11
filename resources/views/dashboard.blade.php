<x-layout>
    <main class="pb-16 px-6 pt-32 max-w-7xl mx-auto">
        
        <!-- Profile Header Widget -->
        <div class="bg-[#18181b] rounded-3xl p-8 md:p-12 border border-white/10 shadow-2xl flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl"></div>
            
            <!-- Avatar -->
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-gradient-to-tr from-purple-500 to-cyan-500 flex items-center justify-center text-4xl md:text-5xl text-white font-bold shadow-inner relative z-10">
                {{ substr($user->name, 0, 1) }}
            </div>
            
            <!-- User Info -->
            <div class="text-center md:text-left relative z-10 flex-grow">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">{{ $user->name }}</h1>
                <p class="text-gray-400 text-lg mb-6">{{ $user->email }}</p>
                
                <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                    <a href="{{ route('profile.edit') }}" class="bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-colors flex items-center gap-2 border border-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Account Settings
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="relative z-10 bg-black/40 px-8 py-6 rounded-2xl border border-white/5 text-center">
                <div class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">
                    {{ $reviews->count() }}
                </div>
                <div class="text-sm text-gray-400 font-semibold uppercase tracking-widest mt-1">Total Reviews</div>
            </div>
        </div>

        <!-- User's Activity (Reviews) Section -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                My Recent Activity
            </h2>

            @if($reviews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($reviews as $review)
                        @php
                            // Media type ke hisaab se link aur color set karna
                            $route = '#';
                            $badgeColor = 'text-gray-400 bg-gray-400/10 border-gray-400/30';
                            
                            if($review->media_type == 'movie') {
                                $route = route('movie.show', $review->media_id);
                                $badgeColor = 'text-purple-400 bg-purple-400/10 border-purple-400/30';
                            } elseif($review->media_type == 'tv') {
                                $route = route('tv.show', $review->media_id);
                                $badgeColor = 'text-cyan-400 bg-cyan-400/10 border-cyan-400/30';
                            } elseif($review->media_type == 'book') {
                                $route = route('books.show', $review->media_id);
                                $badgeColor = 'text-emerald-400 bg-emerald-400/10 border-emerald-400/30';
                            } elseif($review->media_type == 'music') {
                                $route = route('music.show', $review->media_id);
                                $badgeColor = 'text-rose-400 bg-rose-400/10 border-rose-400/30';
                            }
                        @endphp
                        
                        <div class="bg-[#18181b] p-6 rounded-2xl border border-white/5 hover:border-white/20 hover:-translate-y-1 transition-all flex flex-col h-full group">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-xs font-bold uppercase tracking-widest px-2.5 py-1 rounded-md border {{ $badgeColor }}">
                                    {{ $review->media_type }}
                                </span>
                                <span class="text-xs text-gray-500 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <p class="text-gray-300 flex-grow mb-6 text-sm leading-relaxed">
                                "{{ $review->review_text }}"
                            </p>
                            
                            <a href="{{ $route }}" class="text-sm font-bold text-white group-hover:text-cyan-400 transition-colors inline-flex items-center gap-1.5 mt-auto">
                                View Content 
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-[#18181b] p-12 rounded-2xl border border-white/10 text-center shadow-lg">
                    <div class="text-5xl mb-4">✍️</div>
                    <p class="text-gray-400 text-lg mb-6">You haven't dropped any reviews yet.</p>
                    <a href="/" class="inline-block bg-white text-black font-bold py-2.5 px-6 rounded-full hover:scale-105 transition-transform text-sm">Explore Content</a>
                </div>
            @endif
        </div>
    </main>
</x-layout>