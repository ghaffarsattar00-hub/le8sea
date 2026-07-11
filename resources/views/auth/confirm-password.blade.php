<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-[#0a0a0a] border border-white/10 rounded-3xl p-8 shadow-2xl backdrop-blur-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Security Check</h2>
            </div>

            <div class="mb-6 text-sm text-gray-400 leading-relaxed text-center">
                This is a secure area of the application. Please confirm your password before continuing.
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-colors mt-6">
                    Confirm
                </button>
            </form>
        </div>
    </div>
</x-layout>
