<x-layout>
    <main class="pb-16 px-6 pt-32">
        <div class="max-w-4xl mx-auto text-center mb-10">
            <div class="inline-block border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                <span class="text-xs font-semibold text-emerald-400 uppercase tracking-widest">
                    Library
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Get Lost in <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Great Books.</span>
            </h1>
            
            <form action="{{ route('books.search') }}" method="GET" class="max-w-xl mx-auto mt-8 relative">
                <input type="text" name="query" value="{{ $searchQuery ?? '' }}" placeholder="Search for books, authors, or subjects..." required class="w-full bg-[#18181b] text-white px-6 py-4 rounded-full text-base border border-white/10 focus:outline-none focus:border-emerald-500 transition-all placeholder-gray-500 shadow-lg">
                <button type="submit" class="absolute right-2 top-2 bottom-2 bg-emerald-500 text-black font-bold px-8 rounded-full hover:scale-105 transition-transform">
                    Search
                </button>
            </form>
        </div>

        <section class="max-w-7xl mx-auto mt-16">
            @if(isset($searchQuery))
                <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                    Search Results for <span class="text-emerald-400">"{{ $searchQuery }}"</span> 🔍
                </h2>
            @else
                <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
                    Trending Books <span class="text-xl">📚</span>
                </h2>
            @endif
            
            @if(count($books) > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($books as $book)
                    @php
                        $title = $book['title'] ?? 'Unknown';
                        $author = isset($book['author_name']) ? $book['author_name'][0] : 'Unknown Author';
                        $thumbnail = isset($book['cover_i']) ? 'https://covers.openlibrary.org/b/id/' . $book['cover_i'] . '-L.jpg' : null;
                        $id = str_replace('/works/', '', $book['key']); 
                    @endphp

                    <a href="/books/{{ $id }}" class="group cursor-pointer block">
                        <div class="relative overflow-hidden rounded-2xl aspect-[2/3] bg-gray-800 border border-white/5">
                            @if($thumbnail)
                                <img src="{{ $thumbnail }}" alt="{{ $title }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500 opacity-80 group-hover:opacity-100">
                            @else
                                <div class="flex flex-col items-center justify-center w-full h-full text-gray-500 bg-[#18181b] p-4 text-center">
                                    <span class="text-2xl mb-2">📖</span>
                                    <span class="text-xs">{{ $title }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="mt-3 font-semibold text-lg truncate" title="{{ $title }}">{{ $title }}</h3>
                        <p class="text-sm text-gray-500 truncate">
                            {{ $author }}
                        </p>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="bg-[#18181b] p-16 rounded-2xl border border-white/10 text-center shadow-lg mt-8">
                    <div class="text-5xl mb-4">📖</div>
                    <p class="text-gray-400 text-lg mb-6">No books found matching "<span class="text-white">{{ $searchQuery }}</span>".</p>
                    <a href="{{ route('books.index') }}" class="inline-block bg-white text-black font-bold py-2.5 px-6 rounded-full hover:scale-105 transition-transform text-sm">Back to Library</a>
                </div>
            @endif
        </section>
    </main>
</x-layout>