<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
            <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">cms</a>
            <span class="text-slate-600">/</span>
            <span class="text-vermilion-400">profile</span>
        </div>
        <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
            {{ __('Pengaturan Profil Administrator') }}
        </h1>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-carbon-900 border border-carbon-800 shadow-xl rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-carbon-900 border border-carbon-800 shadow-xl rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-carbon-900 border border-carbon-800 shadow-xl rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
