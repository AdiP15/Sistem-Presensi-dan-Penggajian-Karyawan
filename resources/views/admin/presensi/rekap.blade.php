@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 mb-8 relative overflow-hidden">
        <!-- Dekorasi Blur Background -->
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-emerald-400 rounded-full blur-3xl opacity-10 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col xl:flex-row xl:items-center justify-between gap-8">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-fuchsia-400 text-white flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-700 tracking-tight">Rekapitulasi Presensi</h2>
                    <p class="text-sm text-slate-500 font-medium mt-1">
                        Periode Analisis:
                        <span class="px-2 py-1 bg-slate-100 rounded text-slate-700 font-bold ml-1">
                            {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y') }}
                        </span>
                        <span class="mx-1 text-slate-400">-</span>
                        <span class="px-2 py-1 bg-slate-100 rounded text-slate-700 font-bold">
                            {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') }}
                        </span>
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.presensi.rekap') }}" method="GET" class="flex flex-wrap items-end gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200/60">
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5 ml-1 uppercase tracking-widest">Dari Tanggal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500/20 focus:border-violet-500 transition cursor-pointer shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-500 mb-1.5 ml-1 uppercase tracking-widest">Sampai Tanggal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500/20 focus:border-violet-500 transition cursor-pointer shadow-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-slate-800 hover:bg-slate-800 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-slate-900/20 active:scale-95 h-[42px]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Terapkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 border-b border-slate-100 text-[10px] uppercase font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-5 text-slate-500 rounded-tl-[2rem]">Nama Karyawan</th>
                        <th class="px-6 py-5 text-center text-violet-500">Total Hadir</th>
                        <th class="px-6 py-5 text-center text-amber-600">Total Izin</th>
                        <th class="px-6 py-5 text-center text-red-600">Total Sakit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($rekap as $data)
                    <tr class="hover:bg-slate-50/50 transition-colors duration-200 group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-slate-100 to-slate-200 text-slate-600 flex items-center justify-center text-lg font-black uppercase shadow-inner border border-white group-hover:scale-105 transition-transform">
                                    {{ substr($data['nama'], 0, 1) }}
                                </div>
                                <span class="font-extrabold text-slate-700 text-base group-hover:text-emerald-700 transition">{{ $data['nama'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 font-black border border-emerald-200 shadow-sm text-lg">
                                {{ $data['hadir'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50 text-amber-700 font-black border border-amber-200 shadow-sm text-lg">
                                {{ $data['izin'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-50 text-red-700 font-black border border-red-200 shadow-sm text-lg">
                                {{ $data['sakit'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-500">Tidak ada rekap presensi pada periode yang dipilih.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
