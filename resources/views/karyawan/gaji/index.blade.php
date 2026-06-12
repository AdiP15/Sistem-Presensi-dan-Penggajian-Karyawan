@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Dokumen Penghasilan</h1>
        <p class="text-slate-500 text-sm mt-1 font-medium">Arsip resmi slip gaji dan rincian kompensasi bulanan Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($gajis as $gaji)
        <div class="relative bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 group hover:-translate-y-1">
            <div class="absolute top-0 left-0 w-full h-[6px] bg-gradient-to-r from-violet-400 to-fuchsia-500"></div>
            
            <!-- Watermark -->
            <div class="absolute -right-6 -bottom-6 opacity-[0.03] text-emerald-900 pointer-events-none group-hover:scale-110 transition-transform duration-500">
                <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
            </div>

            <div class="p-8 relative z-10">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Periode Pembayaran</p>
                        <h3 class="text-xl font-extrabold text-slate-700">{{ $gaji->bulan }} {{ $gaji->tahun }}</h3>
                    </div>
                    <div class="p-2.5 bg-violet-50 rounded-xl text-violet-500 shadow-sm border border-violet-100 relative group-hover:bg-violet-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>

                <div class="space-y-3 mb-8 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                    <div class="flex justify-between text-sm items-center">
                        <span class="text-slate-500 font-medium">Gaji Pokok Dasar</span>
                        <span class="font-mono font-bold text-slate-700">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm items-center">
                        <span class="text-slate-500 font-medium">Total Penambahan</span>
                        <span class="font-mono font-black text-violet-500">+ Rp {{ number_format($gaji->uang_makan + $gaji->uang_transport + $gaji->uang_lembur, 0, ',', '.') }}</span>
                    </div>
                    @if(($gaji->potongan + $gaji->denda_keterlambatan) > 0)
                    <div class="flex justify-between text-sm items-center">
                        <span class="text-slate-500 font-medium">Total Potongan</span>
                        <span class="font-mono font-black text-red-500">- Rp {{ number_format($gaji->potongan + $gaji->denda_keterlambatan, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <div class="border-t border-slate-200/60 pt-3 flex justify-between items-end mt-3">
                        <span class="font-bold text-slate-700 text-xs uppercase tracking-wider">Take Home Pay</span>
                        <span class="font-black text-xl text-slate-900 font-mono tracking-tight bg-white px-3 py-1 rounded-lg border border-slate-200 shadow-sm">
                            Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('karyawan.gaji.preview', $gaji->id) }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 hover:text-violet-500 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Pratinjau
                    </a>
                    <a href="{{ route('karyawan.gaji.cetak', $gaji->id) }}" class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-slate-800 border border-transparent text-white font-bold text-sm hover:bg-violet-500 transition-colors shadow-xl shadow-slate-900/10 hover:shadow-violet-500/20 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Simpan PDF
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 bg-white rounded-[2rem] border border-slate-200 border-dashed shadow-sm">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <p class="text-slate-500 font-bold">Belum ada dokumen slip gaji diterbitkan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
