<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 antialiased font-sans py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-teal-600 hover:text-teal-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-cyan-600 p-6 text-white">
                    <h2 class="text-xl font-extrabold tracking-tight">Formulir Pengajuan Surat Keterangan</h2>
                    <p class="text-xs text-teal-100 mt-1">Silakan pilih jenis surat dan isi alasan pengajuan secara formal.</p>
                </div>

                <form action="{{ route('submissions.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">NRP Mahasiswa</label>
                            <input type="text" value="{{ auth()->user()->nrp }}" disabled class="mt-1 block w-full rounded-lg border-slate-200 bg-slate-100 text-sm font-semibold text-slate-600 cursor-not-allowed shadow-sm focus:outline-none focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" disabled class="mt-1 block w-full rounded-lg border-slate-200 bg-slate-100 text-sm font-semibold text-slate-600 cursor-not-allowed shadow-sm focus:outline-none focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Program Studi / Jurusan</label>
                            <input type="text" value="{{ auth()->user()->department->name ?? '-' }}" disabled class="mt-1 block w-full rounded-lg border-slate-200 bg-slate-100 text-sm font-semibold text-slate-600 cursor-not-allowed shadow-sm focus:outline-none focus:ring-0">
                        </div>
                    </div>

                    <div>
                        <label for="type" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Jenis Surat Keterangan yang Diajukan</label>
                        <select id="type" name="type" required class="mt-2 block w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm text-slate-700 font-medium">
                            <option value="aktif">Surat Keterangan Mahasiswa Aktif</option>
                            <option value="pengantar_tugas">Surat Pengantar Tugas Mata Kuliah</option>
                            <option value="lulus">Surat Keterangan Lulus (SKL)</option>
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Maksud & Keperluan Alasan Pengajuan</label>
                        <textarea id="description" name="description" rows="5" required class="mt-2 block w-full rounded-xl border-slate-200 bg-white shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 text-sm placeholder-slate-400 text-slate-700" placeholder="Contoh: Digunakan untuk keperluan lampiran pendaftaran Magang Kerja nyata di PT. XYZ..."></textarea>
                        <p class="mt-2 text-xs text-slate-400">Berikan deskripsi alasan yang jelas dan formal agar mempermudah Ketua Program Studi menyetujui pengajuan Anda.</p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-3 px-6 text-sm font-bold text-white shadow-md shadow-teal-600/10 hover:shadow-lg hover:shadow-teal-600/20 transition-all duration-300 hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            Kirim Berkas Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>