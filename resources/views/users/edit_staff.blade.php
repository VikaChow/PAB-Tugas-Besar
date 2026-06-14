<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 antialiased font-sans py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div>
                <a href="{{ route('users.staff') }}" class="inline-flex items-center gap-2 text-sm font-bold text-teal-600 hover:text-teal-700 transition">
                    <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Kembali ke Daftar Staf
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-cyan-600 p-6 text-white">
                    <h2 class="text-xl font-extrabold tracking-tight">Ubah Data Karyawan / Staf</h2>
                    <p class="text-xs text-teal-100 mt-1">Menyunting profil akun dari: <span class="font-bold underline">{{ $user->name }}</span></p>
                </div>

                <form action="{{ route('users.staff.update', $user->id) }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="nrp" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">NIDN / Nomor Induk Pegawai</label>
                        <input type="text" id="nrp" name="nrp" value="{{ old('nrp', $user->nrp) }}" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium">
                        <x-input-error :messages="$errors->get('nrp')" class="mt-1" />
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lengkap Karyawan beserta Gelar</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat Email Resmi</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <label for="role" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Hak Akses Struktural (Peran)</label>
                        <select id="role" name="role" required class="mt-2 block w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium">
                            <option value="tu" {{ old('role', $user->role) === 'tu' ? 'selected' : '' }}>Tata Usaha (Operator & Upload Surat)</option>
                            <option value="kaprodi" {{ old('role', $user->role) === 'kaprodi' ? 'selected' : '' }}>Ketua Program Studi (Otoritas Verifikasi & Approve)</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Kata Sandi Baru (Kosongkan jika tidak diganti)</label>
                        <input type="password" id="password" name="password" 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium" placeholder="Isi jika rekan staf meminta pemulihan password...">
                        <p class="mt-1.5 text-[11px] text-slate-400">Biarkan kosong jika tidak ada permintaan penyetelan ulang sandi.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-6 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 focus:outline-none">
                            Simpan Pembaruan Staf
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>