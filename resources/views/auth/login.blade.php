<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            Selamat Datang Kembali
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Silakan masuk ke Portal Pengajuan Surat Keterangan
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Akun')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="email" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Kata Sandi (Password)')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="password" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between text-sm">
            @if (Route::has('password.request'))
                <a class="text-xs font-bold text-teal-600 hover:text-teal-700 transition" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-4 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                {{ __('Masuk ke Portal') }}
            </button>
        </div>
    </form>
</x-guest-layout>