@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Riwayat Penggajian</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Daftar slip gaji dan kompensasi bulanan yang telah diterbitkan.</p>
        </div>
        <a href="{{ route('admin.gaji.create') }}" class="bg-violet-500 hover:bg-violet-400 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-lg shadow-violet-500/20 flex items-center gap-2 transform hover:-translate-y-0.5 border border-transparent hover:border-violet-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Buat Slip Gaji Baru
        </a>
    </div>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="bg-violet-50 border border-violet-200 text-emerald-800 px-5 py-4 rounded-2xl relative mb-6 flex items-center gap-3 shadow-sm">
            <div class="p-2 bg-emerald-100 text-violet-500 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
            <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700 p-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-slate-500 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 rounded-tl-[2rem]">Profil Karyawan</th>
                        <th class="px-6 py-5">Periode</th>
                        <th class="px-6 py-5">Gaji Dasar</th>
                        <th class="px-6 py-5">Total Penambahan</th>
                        <th class="px-6 py-5 text-red-500">Total Potongan</th>
                        <th class="px-6 py-5">Total Diterima</th>
                        <th class="px-6 py-5 text-center rounded-tr-[2rem]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @foreach($gajis as $gaji)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-slate-100 to-slate-200 flex items-center justify-center text-slate-500 font-black text-sm uppercase shadow-inner border border-white">
                                    {{ substr($gaji->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-extrabold text-slate-700 block group-hover:text-emerald-700 transition-colors">{{ $gaji->user->name }}</span>
                                    <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400">{{ $gaji->user->role }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-50/50 border border-violet-100 text-emerald-700 text-xs font-bold shadow-sm">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $gaji->bulan }} {{ $gaji->tahun }}
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono font-medium text-slate-500">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 font-mono font-bold text-violet-500">+ Rp {{ number_format($gaji->uang_makan + $gaji->uang_transport + $gaji->uang_lembur, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 font-mono font-bold text-red-500">- Rp {{ number_format($gaji->potongan + $gaji->denda_keterlambatan, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <div class="px-3 py-1.5 bg-slate-800 rounded-lg text-white font-mono font-bold text-sm inline-block shadow-md">
                                Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.gaji.preview', $gaji->id) }}" target="_blank" class="p-2 bg-slate-50 text-slate-400 hover:bg-violet-50 hover:text-violet-500 rounded-xl border border-slate-200 hover:border-violet-200 transition-all shadow-sm" title="Preview Slip">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <a href="{{ route('admin.gaji.cetak', $gaji->id) }}" class="p-2 bg-slate-50 text-slate-400 hover:bg-blue-50 hover:text-blue-600 rounded-xl border border-slate-200 hover:border-blue-200 transition-all shadow-sm" title="Download PDF">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                                <form action="{{ route('admin.gaji.destroy', $gaji->id) }}" method="POST" onsubmit="return confirm('Hapus data gaji ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-600 rounded-xl border border-slate-200 hover:border-red-200 transition-all shadow-sm" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($gajis->isEmpty())
            <div class="p-16 text-center text-slate-400 flex flex-col items-center">
                <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <p class="font-semibold">Belum ada riwayat penggajian terdaftar.</p>
                <a href="{{ route('admin.gaji.create') }}" class="mt-4 text-violet-500 font-bold hover:underline">Buat Slip Gaji Pertama</a>
            </div>
        @endif
    </div>
</div>
@endsection
