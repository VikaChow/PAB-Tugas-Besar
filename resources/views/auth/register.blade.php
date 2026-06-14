<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            Pendaftaran Akun Baru
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Silakan lengkapi data identitas Anda secara benar
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="nrp" :value="__('NRP / Nomor Induk')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="nrp" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="text" name="nrp" :value="old('nrp')" required autofocus placeholder="Contoh: 2272001 atau D00123" />
            <x-input-error :messages="$errors->get('nrp')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="name" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Masukkan nama lengkap Anda..." />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="email" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="department_id" :value="__('Program Studi / Jurusan')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <select id="department_id" name="department_id" required class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium">
                <option value="" disabled selected>-- Pilih Program Studi --</option>
                @foreach(\App\Models\Department::all() as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Kata Sandi (Password)')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="password" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Minimal 8 karakter..." />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-xs font-bold text-slate-500 uppercase tracking-wide" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi kata sandi..." />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2 text-sm">
            <a class="text-xs font-bold text-slate-400 hover:text-slate-600 underline decoration-slate-200 transition" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <button type="submit" class="inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-6 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                {{ __('Daftar Akun') }}
            </button>
        </div>
    </form>
</x-guest-layout>