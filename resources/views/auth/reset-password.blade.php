<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
            <span>Perbarui Kata Sandi</span>
        </h1>
        <p class="text-xs text-slate-400 mt-1 leading-relaxed">
            Silakan masukkan kata sandi baru untuk akun administrator Anda.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" 
                          type="email" 
                          name="email" 
                          :value="old('email', $request->email)" 
                          required 
                          autofocus 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi Baru')" />
            <x-text-input id="password" 
                          type="password" 
                          name="password" 
                          required 
                          autocomplete="new-password" 
                          placeholder="••••••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
            <x-text-input id="password_confirmation" 
                          type="password"
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password" 
                          placeholder="••••••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Simpan Kata Sandi Baru') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
