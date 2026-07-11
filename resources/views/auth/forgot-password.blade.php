<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-[#0a0a0a] border border-white/10 rounded-3xl p-8 shadow-2xl backdrop-blur-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Reset Password</h2>
            </div>

            <div class="mb-6 text-sm text-gray-400 leading-relaxed text-center">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus class="w-full bg-[#18181b] text-white px-4 py-3 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-colors mt-6">
                    Email Password Reset Link
                </button>
            </form>

            <p class="text-center text-gray-400 mt-6 text-sm">
                Remember your password? <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Log in</a>
            </p>
        </div>
    </div>
</x-layout>
