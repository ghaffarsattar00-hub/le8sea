<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le8sea - Let's see what's next.</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #09090b; 
            color: #ffffff;
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #3f3f46; }
    </style>
</head>
<body class="antialiased selection:bg-purple-500 selection:text-white">

    <nav class="fixed w-full z-50 bg-[#09090b]/80 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-extrabold tracking-tighter hover:scale-105 transition-transform">
                le<span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">8</span>sea.
            </a>
            
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-gray-400">
                <a href="/" class="hover:text-white transition-colors">Movies</a>
                <a href="{{ route('tv.index') }}" class="hover:text-white transition-colors">TV Shows</a>
                <a href="{{ route('books.index') }}" class="hover:text-white transition-colors">Books</a>
                <!-- Yahan humne Music ka link active kar diya hai -->
                <a href="{{ route('music.index') }}" class="hover:text-white transition-colors">Music</a>
                
                <form action="{{ route('movie.search') }}" method="GET" class="relative group ml-4">
                    <input type="text" name="query" placeholder="Search movies/tv..." required class="bg-[#18181b] text-white px-4 py-2 rounded-full text-sm border border-white/10 focus:outline-none focus:border-cyan-500 transition-all w-48 focus:w-64 placeholder-gray-500">
                    <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-cyan-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <!-- Yahan humne text ko <a> tag mein badal kar dashboard ka link de diya hai -->
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400 hover:opacity-80 transition-opacity">
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/10 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-white/20 transition-colors">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-white">Log in</a>
                    <a href="{{ route('register') }}" class="bg-white text-black px-5 py-2 rounded-full text-sm font-semibold hover:scale-105 transition-transform duration-200">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="pt-24"> 
        {{ $slot }}
    </div>

</body>
</html>