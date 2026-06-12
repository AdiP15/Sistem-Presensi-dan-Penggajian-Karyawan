@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Riwayat Kehadiran</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Log aktivitas presensi dan pencatatan waktu Anda.</p>
        </div>
        <div class="text-xs font-bold text-emerald-700 bg-violet-50 px-4 py-2 rounded-xl border border-violet-100 shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Total: {{ $riwayat->count() }} Hari
        </div>
    </div>

    <div class="space-y-5">
        @forelse($riwayat as $p)
        <div class="group relative overflow-hidden bg-white rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-500/5 transition duration-300 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            
            <!-- Deco line -->
            <div class="absolute left-0 top-0 bottom-0 w-2 {{ $p->status == 'hadir' ? 'bg-gradient-to-b from-violet-400 to-fuchsia-500' : ($p->status == 'izin' ? 'bg-gradient-to-b from-amber-400 to-amber-500' : 'bg-gradient-to-b from-rose-400 to-red-500') }}"></div>

            <div class="flex items-center gap-5 pl-2">
                <div class="flex flex-col items-center justify-center w-16 h-16 bg-slate-50 rounded-2xl border border-slate-200 shadow-sm group-hover:scale-105 transition-transform">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($p->tanggal)->format('M') }}</span>
                    <span class="text-2xl font-black text-slate-700 leading-none mt-0.5">{{ \Carbon\Carbon::parse($p->tanggal)->format('d') }}</span>
                </div>
                <div>
                    <span class="inline-flex px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider mb-2 shadow-sm border
                        {{ $p->status == 'hadir' ? 'bg-emerald-50 text-emerald-500 border-emerald-200' : ($p->status == 'izin' ? 'bg-amber-50 text-amber-500 border-amber-200' : 'bg-red-50 text-red-500 border-red-200') }}">
                        {{ $p->status }}
                    </span>
                    <p class="text-sm text-slate-600 font-bold">
                        {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('l, d F Y') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-100 mr-2">
                <div class="text-center w-16">
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-1">Masuk</p>
                    <p class="text-lg font-mono font-black text-slate-700">{{ $p->jam_masuk ?? '--:--' }}</p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div class="text-center w-16">
                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest mb-1">Pulang</p>
                    <p class="text-lg font-mono font-black text-slate-700">{{ $p->jam_pulang ?? '--:--' }}</p>
                </div>
            </div>

        </div>
        @empty
        <div class="text-center py-16 bg-white rounded-[2rem] border border-slate-200 border-dashed shadow-sm">
            <div class="inline-flex p-5 rounded-full bg-slate-50 border border-slate-100 text-slate-300 mb-4 shadow-inner">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-slate-500 font-bold mb-1">Anda belum memiliki riwayat presensi.</p>
            <p class="text-slate-400 text-sm">Catatan kehadiran akan muncul di sini setelah Anda melakukan absensi.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
