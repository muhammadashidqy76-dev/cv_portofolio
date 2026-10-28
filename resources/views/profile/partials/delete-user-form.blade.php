<section class="space-y-6">
    <header>
        <h2 class="text-base font-bold font-mono text-rose-400">
            {{ __('Hapus Akun Administrator') }}
        </h2>

        <p class="mt-1 text-xs text-slate-400">
            {{ __('Setelah akun dihapus, semua data sesi dan hak akses pengelolaan CMS akan ditutup secara permanen.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-base font-bold font-mono text-white">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-2 text-xs text-slate-400">
                {{ __('Setelah akun dihapus, semua hak akses CMS akan hilang. Silakan masukkan kata sandi Anda untuk mengonfirmasi tindakan ini.') }}
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Konfirmasi Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
