<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-teal-50 text-teal-600 mb-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5" />
            </svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            Verifikasi Email Anda
        </h2>
    </div>

    <div class="mb-5 text-sm text-center text-slate-500 leading-relaxed">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 p-3 rounded-xl bg-emerald-50 border border-emerald-100 text-center text-xs font-semibold text-emerald-800">
            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf

            <div>
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-2.5 px-4 text-xs font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf

            <button type="submit" class="text-xs font-bold text-slate-400 hover:text-slate-600 underline decoration-slate-300 transition focus:outline-none">
                {{ __('Keluar Aplikasi (Log Out)') }}
            </button>
        </form>
    </div>
</x-guest-layout>