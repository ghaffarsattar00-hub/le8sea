<x-layout>
    <div class="min-h-screen py-16 px-6">
        <div class="max-w-4xl mx-auto space-y-8 mt-12">
            
            <div class="mb-8">
                <h2 class="text-4xl font-extrabold text-white tracking-tight">
                    Account Settings
                </h2>
                <p class="text-gray-400 mt-2 text-lg">Manage your profile information, password, and security preferences.</p>
            </div>

            <div class="p-6 sm:p-10 bg-[#0a0a0a] border border-white/10 shadow-2xl rounded-3xl backdrop-blur-md">
                <div class="max-w-xl text-gray-300">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-[#0a0a0a] border border-white/10 shadow-2xl rounded-3xl backdrop-blur-md">
                <div class="max-w-xl text-gray-300">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-red-950/20 border border-red-500/20 shadow-2xl rounded-3xl backdrop-blur-md relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500/0 via-red-500/5 to-red-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="max-w-xl text-gray-300 relative z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-layout>
