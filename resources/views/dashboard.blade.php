<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 antialiased font-sans">
        
        <div class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-10 backdrop-blur-md bg-white/90">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <span class="text-xs font-bold tracking-wider uppercase text-teal-600 bg-teal-50 px-2.5 py-1 rounded-full">
                            Akses Portal: {{ auth()->user()->role }}
                        </span>
                        <h1 class="text-2xl font-extrabold text-slate-900 mt-2 tracking-tight">
                            Sistem Informasi Pengajuan Surat Keterangan
                        </h1>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-100/80 px-4 py-2.5 rounded-xl border border-slate-200/60 w-fit">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                        <p class="text-sm font-medium text-slate-700">
                            Prodi: <span class="font-bold text-slate-900">{{ auth()->user()->department->name ?? 'Semua Prodi' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-900 shadow-sm flex items-center gap-3 animate-fade-in">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200/80 text-rose-900 shadow-sm flex items-center gap-3 animate-fade-in">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2 2 2m0-4l-2 2-2-2m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Surat Terdata</p>
                        <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $submissions->count() }}</h3>
                    </div>
                    <div class="p-3.5 bg-teal-50 text-teal-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menunggu Tinjauan</p>
                        <h3 class="text-3xl font-black text-amber-600 mt-1">{{ $submissions->where('status', 'pending')->count() }}</h3>
                    </div>
                    <div class="p-3.5 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Telah Disetujui</p>
                        <h3 class="text-3xl font-black text-emerald-600 mt-1">{{ $submissions->where('status', 'approved')->count() }}</h3>
                    </div>
                    <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden lg:col-span-3">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 tracking-tight text-lg">
                            {{ auth()->user()->role === 'mahasiswa' ? 'Riwayat Pengajuan Dokumen Anda' : 'Daftar Antrean Dokumen Masuk' }}
                        </h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead>
                                <tr class="bg-slate-50/70">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Masuk</th>
                                    @if(auth()->user()->role !== 'mahasiswa')
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Pemohon (Mhs)</th>
                                    @endif
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Dokumen</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Keperluan / Alasan</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Status Berkas</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi Operasional</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse($submissions as $sub)
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                            {{ $sub->created_at->format('d M Y') }}
                                            <span class="block text-xs text-slate-400 font-normal mt-0.5">{{ $sub->created_at->format('H:i') }} WIB</span>
                                        </td>
                                        
                                        @if(auth()->user()->role !== 'mahasiswa')
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-slate-800">{{ $sub->user->name }}</div>
                                                <div class="text-xs font-semibold text-teal-600 mt-0.5">NRP: {{ $sub->user->nrp }}</div>
                                                <div class="text-[10px] text-slate-400 font-normal mt-0.5">Jurusan: {{ $sub->department->name ?? '-' }}</div>
                                            </td>
                                        @endif

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-slate-800 block">
                                                @if($sub->type === 'aktif') Surat Keterangan Mahasiswa Aktif
                                                @elseif($sub->type === 'pengantar_tugas') Surat Pengantar Tugas Kuliah
                                                @elseif($sub->type === 'lulus') Surat Keterangan Lulus (SKL)
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                            {{ $sub->description ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($sub->status === 'pending')
                                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200/50">Menunggu Kaprodi</span>
                                            @elseif($sub->status === 'approved')
                                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-teal-50 text-teal-700 border border-teal-200/50">Disetujui Kaprodi</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-rose-50 text-rose-700 border border-rose-200/50">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            
                                            @if(auth()->user()->role === 'mahasiswa')
                                                @if($sub->file_path)
                                                    <a href="{{ route('submissions.download', $sub->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs rounded-lg transition shadow-sm shadow-teal-600/10">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                        Unduh PDF
                                                    </a>
                                                @elseif($sub->status === 'rejected')
                                                    <span class="text-rose-500 font-semibold text-xs bg-rose-50 px-2 py-1 rounded">Ditolak</span>
                                                @else
                                                    <span class="text-slate-400 italic text-xs flex items-center justify-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span> Antrean TU</span>
                                                @endif
                                            @endif

                                            @if(auth()->user()->role === 'kaprodi')
                                                @if($sub->status === 'pending')
                                                    <div class="flex items-center justify-center gap-2">
                                                        <form action="{{ route('submissions.approve', $sub->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm transition">Setuju</button>
                                                        </form>
                                                        <form action="{{ route('submissions.reject', $sub->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="text-white bg-rose-600 hover:bg-rose-700 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm transition">Tolak</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-slate-400 text-xs font-medium">Selesai Ditinjau</span>
                                                @endif
                                            @endif

                                            @if(in_array(auth()->user()->role, ['tu', 'manager']))
                                                @if($sub->status === 'approved')
                                                    <div class="flex flex-col items-center gap-1.5">
                                                        @if($sub->file_path)
                                                            <span class="text-emerald-600 text-xs font-bold bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/50 flex items-center gap-1">
                                                                ✓ Berkas Siap
                                                            </span>
                                                        @endif
                                                        <form action="{{ route('submissions.upload', $sub->id) }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                                                            @csrf
                                                            <label class="cursor-pointer bg-slate-100 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg text-xs font-semibold hover:bg-slate-200 transition">
                                                                Pilih PDF
                                                                <input type="file" name="document" accept=".pdf" required class="hidden" onchange="this.form.submit()"/>
                                                            </label>
                                                        </form>
                                                    </div>
                                                @elseif($sub->status === 'pending')
                                                    <span class="text-amber-500 bg-amber-50 border border-amber-100 text-xs px-2.5 py-1 rounded-full font-medium">Menunggu Kaprodi</span>
                                                @else
                                                    <span class="text-slate-400 text-xs font-medium">-</span>
                                                @endif
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 whitespace-nowrap text-sm text-center text-slate-400 font-medium">
                                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-4a2 2 0 00-2 2v1a2 2 0 01-2 2H8a2 2 0 01-2-2v-1a2 2 0 00-2-2H2"/></svg>
                                            Belum ada rekaman pengajuan berkas surat di program studi ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>