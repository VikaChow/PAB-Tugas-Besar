<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-teal-50 text-teal-600 mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            Konfirmasi Kata Sandi
        </h2>
    </div>

    <div class="mb-5 text-sm text-center text-slate-500 leading-relaxed">
        {{ __('Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi (password) akun Anda terlebih dahulu sebelum melanjutkan akses.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Kata Sandi (Password)')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="password" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-4 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                {{ __('Konfirmasi Akses') }}
            </button>
        </div>
    </form>
</x-guest-layout>