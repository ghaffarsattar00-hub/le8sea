<x-layout>
    <div class="min-h-[80vh] flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md bg-[#0a0a0a] border border-white/10 rounded-3xl p-8 shadow-2xl backdrop-blur-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Verify Your Email</h2>
            </div>

            <div class="mb-6 text-sm text-gray-400 leading-relaxed text-center">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-medium text-sm text-cyan-400 text-center bg-cyan-400/10 py-3 rounded-lg border border-cyan-400/20">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <div class="flex flex-col space-y-4 items-center">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-xl hover:bg-gray-200 transition-colors">
                        Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-transparent border border-white/10 text-gray-300 font-bold py-3.5 rounded-xl hover:bg-white/5 transition-colors">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
