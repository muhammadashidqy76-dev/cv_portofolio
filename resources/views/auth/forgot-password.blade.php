<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
            <span>Pemulihan Kata Sandi</span>
        </h1>
        <p class="text-xs text-slate-400 mt-1 leading-relaxed">
            Lupa kata sandi? Masukkan email administrator terdaftar untuk menerima tautan pembuatan kata sandi baru.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          placeholder="admin@ashidqy.dev" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="pt-2 flex flex-col gap-3">
            <x-primary-button class="w-full">
                {{ __('Kirim Tautan Reset') }}
            </x-primary-button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-xs font-mono text-slate-400 hover:text-white transition-colors">
                    &larr; {{ __('Kembali ke Halaman Login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
