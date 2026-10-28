<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
            <span>Masuk ke Console CMS</span>
        </h1>
        <p class="text-xs text-slate-400 mt-1">
            Gunakan kredensial akun administrator untuk mengelola konten dan portofolio.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
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
                          autocomplete="username" 
                          placeholder="admin@ashidqy.dev" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Password')" class="!mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-mono text-slate-400 hover:text-vermilion-400 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password"
                          type="password"
                          name="password"
                          required 
                          autocomplete="current-password" 
                          placeholder="••••••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                <input id="remember_me" 
                       type="checkbox" 
                       class="w-4 h-4 rounded border-carbon-800 bg-carbon-950 text-vermilion-500 focus:ring-vermilion-500/20 focus:ring-offset-0 focus:ring-offset-transparent cursor-pointer" 
                       name="remember">
                <span class="text-xs font-mono text-slate-400">{{ __('Ingat sesi saya') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Masuk ke Console') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
