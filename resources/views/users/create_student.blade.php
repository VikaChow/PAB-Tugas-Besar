<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 antialiased font-sans py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div>
                <a href="{{ route('users.students') }}" class="inline-flex items-center gap-2 text-sm font-bold text-teal-600 hover:text-teal-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Daftar Mahasiswa
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-cyan-600 p-6 text-white">
                    <h2 class="text-xl font-extrabold tracking-tight">Formulir Tambah Mahasiswa Baru</h2>
                    <p class="text-xs text-teal-100 mt-1">Input data akademis mahasiswa untuk Program Studi: <span class="font-bold underline">{{ auth()->user()->department->name ?? '-' }}</span></p>
                </div>

                <form action="{{ route('users.storeStudent') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    
                    <div>
                        <label for="nrp" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">NRP / Nomor Pokok Mahasiswa</label>
                        <input type="text" id="nrp" name="nrp" value="{{ old('nrp') }}" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium placeholder-slate-400" 
                               placeholder="Contoh: 2373036">
                        <x-input-error :messages="$errors->get('nrp')" class="mt-1" />
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lengkap Mahasiswa</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium placeholder-slate-400" 
                               placeholder="Masukkan nama sesuai KTP/Ijazah...">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat Email Mahasiswa</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium placeholder-slate-400" 
                               placeholder="Contoh: nama@mahasiswa.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Kata Sandi Default (Awal)</label>
                        <input type="password" id="password" name="password" required 
                               class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50/50 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium placeholder-slate-400" 
                               placeholder="Minimal 8 karakter (Misal: 12345678)">
                        <p class="mt-1.5 text-[11px] text-slate-400">Mahasiswa dapat mengganti kata sandi ini secara mandiri melalui menu profil mereka.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-6 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            Simpan Data Mahasiswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>