<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            Lupa Kata Sandi?
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Jangan khawatir, kami akan membantu memulihkan akun Anda
        </p>
    </div>

    <div class="mb-5 text-sm text-slate-500 leading-relaxed text-center">
        {{ __('Silakan masukkan alamat email akun Anda di bawah ini. Kami akan mengirimkan tautan (link) atur ulang kata sandi yang memungkinkan Anda untuk membuat kata sandi baru.') }}
    </div>

    @if (session('status'))
        <div class="mb-5 p-3 rounded-xl bg-emerald-50 border border-emerald-100 text-center text-xs font-semibold text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="email" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2 text-sm gap-4">
            <a class="text-xs font-bold text-slate-400 hover:text-slate-600 underline decoration-slate-200 transition" href="{{ route('login') }}">
                {{ __('Kembali ke Login') }}
            </a>

            <button type="submit" class="inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-5 text-xs font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                {{ __('Kirim Tautan') }}
            </button>
        </div>
    </form>
</x-guest-layout>