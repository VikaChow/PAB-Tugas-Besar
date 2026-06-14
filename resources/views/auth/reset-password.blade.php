<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            Atur Ulang Kata Sandi
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Silakan masukkan kata sandi baru Anda dengan aman
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email Akun')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="email" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="Masukkan email Anda..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Kata Sandi Baru')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="password" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-4 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                {{ __('Perbarui Kata Sandi') }}
            </button>
        </div>
    </form>
</x-guest-layout>