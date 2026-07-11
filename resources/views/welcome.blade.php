<x-layout>
    <nav x-data="{ open: false }" class="bg-[#18181b] border-b border-white/10 relative z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-extrabold text-white tracking-tighter">
                        Rev<span class="text-cyan-500">AI</span>.
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Movies</a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">TV Shows</a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors text-sm font-medium">Books</a>
                    <a href="#" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors border border-white/10 backdrop-blur-sm">
                        Sign In
                    </a>
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="open = ! open" class="text-gray-400 hover:text-white focus:outline-none p-2">
                        <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden absolute top-20 left-0 w-full bg-[#18181b]/95 backdrop-blur-xl border-b border-white/10"
             style="display: none;">
            <div class="px-6 pt-2 pb-6 space-y-2 flex flex-col text-center">
                <a href="#" class="text-gray-300 hover:text-white hover:bg-white/5 block px-3 py-3 rounded-xl text-base font-medium transition-colors">Movies</a>
                <a href="#" class="text-gray-300 hover:text-white hover:bg-white/5 block px-3 py-3 rounded-xl text-base font-medium transition-colors">TV Shows</a>
                <a href="#" class="text-gray-300 hover:text-white hover:bg-white/5 block px-3 py-3 rounded-xl text-base font-medium transition-colors">Books</a>
                <div class="pt-4 mt-2 border-t border-white/10">
                    <a href="#" class="inline-block w-full px-5 py-3 bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 rounded-xl text-base font-medium transition-colors">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pb-16 px-6">
        <div class="max-w-4xl mx-auto text-center mt-12">
        <div class="max-w-4xl mx-auto text-center mt-12 md:mt-24">
            <div class="inline-block border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                <span class="text-xs font-semibold text-cyan-400 uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    AI-Powered Reviews
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight text-white">
                Don't just watch. <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-gray-100">Experience it.</span>
            </h1>
@@ -27,13 +78,12 @@
        </div>
    </main>

    <section class="max-w-7xl mx-auto px-6 py-12">
    <section class="max-w-7xl mx-auto px-6 py-12 text-white">
        <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
            Trending This Week <span class="text-xl">🔥</span>
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            
            @foreach($trendingMovies as $movie)
            <a href="/movie/{{ $movie['id'] }}" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-2xl aspect-[2/3] bg-gray-800">
@@ -53,7 +103,6 @@
                </p>
            </a>
            @endforeach

        </div>
    </section>
</x-layout>
</x-layout>
