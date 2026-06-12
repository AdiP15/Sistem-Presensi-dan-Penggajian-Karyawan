@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-700 tracking-tight">Monitoring Harian</h1>
            <p class="text-slate-500 mt-1 text-sm font-medium">Pantau kehadiran dan aktivitas presensi karyawan secara real-time.</p>
        </div>

        <div class="bg-white p-2 rounded-[1.25rem] border border-slate-100 shadow-sm flex items-center gap-2 relative">
            <form action="{{ route('admin.presensi.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="date" name="tanggal" value="{{ $tanggal }}"
                        class="pl-12 pr-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl text-sm text-slate-700 font-bold focus:ring-2 focus:ring-emerald-500/20 focus:border-violet-500 transition cursor-pointer">
                </div>
                <button type="submit" class="px-5 py-2.5 bg-violet-500 hover:bg-violet-400 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-violet-500/20 active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
            </form>
        </div>
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
                        <th class="px-6 py-5">Jam Masuk</th>
                        <th class="px-6 py-5">Jam Pulang</th>
                        <th class="px-6 py-5">Status Hadir</th>
                        <th class="px-6 py-5 text-center">Foto Bukti</th>
                        <th class="px-6 py-5">Keterangan</th>
                        <th class="px-6 py-5 text-center rounded-tr-[2rem]">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    @forelse($presensi as $row)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 text-slate-600 border border-white shadow-inner flex items-center justify-center font-black text-sm uppercase group-hover:scale-105 transition-transform">
                                    {{ substr($row->user->name, 0, 1) }}
                                </div>
                                <span class="font-extrabold text-slate-700 group-hover:text-emerald-700 transition-colors">{{ $row->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono font-bold text-slate-600">{{ $row->jam_masuk ?? '--:--' }}</td>
                        <td class="px-6 py-4 font-mono font-bold text-slate-600">{{ $row->jam_pulang ?? '--:--' }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusClass = match($row->status) {
                                    'hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                    'izin' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'sakit' => 'bg-red-50 text-red-700 border-red-200',
                                    default => 'bg-slate-50 text-slate-600 border-slate-200'
                                };
                            @endphp
                            <span class="inline-flex px-3 py-1.5 rounded-lg text-xs font-bold border {{ $statusClass }} capitalize shadow-sm">
                                {{ $row->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($row->foto_masuk)
                                <a href="{{ asset('storage/presensi/'.$row->foto_masuk) }}" target="_blank" class="inline-flex flex-col items-center gap-1 group/link text-slate-500 hover:text-violet-500 p-2 rounded-xl hover:bg-violet-50 transition-all">
                                    <svg class="w-5 h-5 group-hover/link:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-wider">Lihat</span>
                                </a>
                            @else
                                <span class="text-slate-300 font-bold">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-slate-500 text-xs italic line-clamp-2 max-w-[150px] bg-slate-50 p-2 rounded-lg border border-slate-100 block">
                                {{ $row->keterangan ?? 'Tidak ada' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.presensi.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Hapus data presensi ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl border border-slate-200 text-slate-400 hover:bg-red-50 hover:border-red-200 hover:text-red-600 transition-all shadow-sm" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-500">Belum ada karyawan yang melakukan presensi hari ini.</p>
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
