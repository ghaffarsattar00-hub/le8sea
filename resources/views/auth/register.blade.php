<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-[#0a0a0a] border border-white/10 rounded-3xl p-8 shadow-2xl backdrop-blur-md">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Create Account</h2>
                <p class="text-gray-400 mt-2">Join le8sea. to get AI-powered reviews</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-colors mt-6">
                    Sign Up
                </button>
            </form>

            <p class="text-center text-gray-400 mt-6 text-sm">
                Already registered? <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Log in</a>
            </p>
        </div>
    </div>
</x-layout>
