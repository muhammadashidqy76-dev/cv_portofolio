<section>
    <header>
        <h2 class="text-base font-bold font-mono text-white">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-xs text-slate-400">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang kuat dan aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" placeholder="••••••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" placeholder="••••••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="••••••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>{{ __('Simpan Kata Sandi') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-xs font-mono text-emerald-400"
                >{{ __('Kata sandi berhasil diperbarui.') }}</p>
            @endif
        </div>
    </form>
</section>
