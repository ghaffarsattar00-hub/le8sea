<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-[#0a0a0a] border border-white/10 rounded-3xl p-8 shadow-2xl backdrop-blur-md">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Welcome Back</h2>
                <p class="text-gray-400 mt-2">Log in to your account to continue</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-[#18181b] border-gray-700 text-cyan-500 focus:ring-cyan-500" name="remember">
                        <span class="ms-2 text-sm text-gray-400">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-cyan-400 hover:text-cyan-300" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-colors mt-4">
                    Log in
                </button>
            </form>
            
            <p class="text-center text-gray-400 mt-6 text-sm">
                Don't have an account? <a href="{{ route('register') }}" class="text-white font-bold hover:underline">Sign up</a>
            </p>
        </div>
    </div>
</x-layout>
