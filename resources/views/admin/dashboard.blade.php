@extends('layouts.app')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Welcome Banner -->
        <div class="lg:col-span-2 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-[2rem] p-8 sm:p-10 text-white shadow-xl shadow-emerald-900/20 relative overflow-hidden flex flex-col justify-center group">
            <!-- Blobs -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-emerald-400 rounded-full mix-blend-overlay filter blur-3xl opacity-40 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-teal-400 rounded-full mix-blend-overlay filter blur-3xl opacity-40" style="animation-delay: 2s;"></div>
            
            <div class="absolute right-10 top-10 opacity-10 transform rotate-12 group-hover:scale-110 group-hover:rotate-6 transition duration-700">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1.5 bg-white/20 backdrop-blur-md rounded-lg text-[10px] font-bold border border-white/20 text-emerald-50 uppercase tracking-widest shadow-sm">Admin Workspace</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-3 tracking-tight">Selamat Pagi, {{ Auth::user()->name }}!</h1>
                <p class="text-emerald-50 max-w-lg text-lg mb-8 font-medium">Kelola seluruh data karyawan, pantau presensi, dan proses penggajian harian dalam satu dasbor terpadu.</p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.karyawan.create') }}" class="px-6 py-3.5 bg-white text-emerald-700 hover:bg-violet-50 rounded-xl font-bold shadow-xl shadow-emerald-900/10 transition-all transform hover:-translate-y-1 flex items-center gap-2 border border-transparent hover:border-violet-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Karyawan Baru
                    </a>
                    <a href="{{ route('admin.presensi.index') }}" class="px-6 py-3.5 bg-emerald-800/40 hover:bg-emerald-800/60 text-white rounded-xl font-bold border border-violet-500/30 transition-all transform hover:-translate-y-1 backdrop-blur-md flex items-center gap-2 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Monitor Presensi
                    </a>
                </div>
            </div>
        </div>

        <!-- Clock Widget -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-shadow border border-slate-100 flex flex-col items-center justify-center text-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-emerald-50/50 opacity-50 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10 w-full">
                <div class="w-12 h-12 bg-emerald-100 text-violet-500 rounded-2xl mx-auto flex items-center justify-center mb-4 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-2">Waktu Sistem</p>
                <div id="realtime-clock" class="text-4xl md:text-5xl font-black text-slate-700 tracking-tighter mb-2">
                    --:--:--
                </div>
                <p class="text-violet-500 font-bold text-sm bg-violet-50 py-1.5 px-4 rounded-lg inline-block" id="realtime-date">Memuat...</p>
            </div>
        </div>
    </div>

    <!-- Stats Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <h3 class="text-4xl font-extrabold text-slate-700 mb-1 group-hover:text-blue-600 transition-colors">{{ $totalKaryawan }}</h3>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Karyawan</p>
                </div>
                <div class="p-3.5 bg-blue-50 rounded-2xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-24 h-24 bg-violet-50 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <h3 class="text-4xl font-extrabold text-slate-700 mb-1 group-hover:text-violet-500 transition-colors">{{ $hadirHariIni }}</h3>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Hadir Hari Ini</p>
                </div>
                <div class="p-3.5 bg-violet-50 rounded-2xl text-violet-500 group-hover:bg-violet-500 group-hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-24 h-24 bg-amber-50 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <h3 class="text-4xl font-extrabold text-slate-700 mb-1 group-hover:text-amber-600 transition-colors">
                        {{ \App\Models\Presensi::whereDate('tanggal', date('Y-m-d'))->whereIn('status', ['izin', 'sakit'])->count() }}
                    </h3>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Izin / Sakit</p>
                </div>
                <div class="p-3.5 bg-amber-50 rounded-2xl text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-900/5 transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-24 h-24 bg-indigo-50 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="flex justify-between items-start relative z-10">
                <div class="mt-2">
                    <h3 class="text-2xl font-extrabold text-slate-700 mb-1 group-hover:text-indigo-600 transition-colors uppercase tracking-tight">{{ date('M Y') }}</h3>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Bulan Berjalan</p>
                </div>
                <div class="p-3.5 bg-indigo-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-extrabold text-slate-700 flex items-center gap-3">
                    <div class="p-2 bg-emerald-100 text-violet-500 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Log Presensi Hari Ini
                </h3>
                <a href="{{ route('admin.presensi.index') }}" class="text-xs font-bold text-violet-500 hover:text-emerald-700 bg-violet-50 hover:bg-emerald-100 py-2 px-4 rounded-lg transition-colors">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @php
                    $recent = \App\Models\Presensi::with('user')->whereDate('tanggal', date('Y-m-d'))->latest()->take(5)->get();
                @endphp

                @forelse($recent as $r)
                <div class="flex items-center justify-between p-4 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-slate-100 to-slate-200 flex items-center justify-center text-slate-600 font-extrabold shadow-inner group-hover:scale-105 transition-transform">
                            {{ substr($r->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-slate-700">{{ $r->user->name }}</p>
                            <p class="text-xs text-slate-400 font-medium mt-0.5">
                                {{ $r->jam_pulang ? 'Absen Pulang: '.$r->jam_pulang : 'Absen Masuk: '.$r->jam_masuk }}
                            </p>
                        </div>
                    </div>
                    <span class="px-4 py-1.5 rounded-lg text-xs font-bold capitalize shadow-sm {{ $r->status == 'hadir' ? 'bg-emerald-100 text-emerald-700 border border-violet-200' : 'bg-amber-100 text-amber-700 border border-amber-200' }}">
                        {{ $r->status }}
                    </span>
                </div>
                @empty
                <div class="text-center py-12 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <p class="text-sm font-semibold text-slate-500">Belum ada aktivitas presensi tercatat hari ini.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 h-fit">
            <h3 class="text-lg font-extrabold text-slate-700 mb-6 flex items-center gap-3">
                <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                Tindakan Cepat
            </h3>

            <div class="space-y-3">
                <a href="{{ route('admin.gaji.create') }}" class="flex items-center p-4 rounded-2xl bg-slate-50 hover:bg-violet-50 text-slate-600 hover:text-emerald-700 transition group border border-slate-100 hover:border-violet-200 shadow-sm hover:shadow">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-500 shadow-sm mr-4 group-hover:scale-110 transition shadow-emerald-500/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-extrabold text-sm">Hitung Penggajian</span>
                </a>

                <a href="{{ route('admin.presensi.rekap') }}" class="flex items-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-700 transition group border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-blue-500 shadow-sm mr-4 group-hover:scale-110 transition shadow-blue-500/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="font-extrabold text-sm">Lihat Rekap Bulanan</span>
                </a>

                <a href="{{ route('admin.karyawan.index') }}" class="flex items-center p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition group border border-slate-100 hover:border-slate-300 shadow-sm hover:shadow">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-500 shadow-sm mr-4 group-hover:scale-110 transition shadow-slate-500/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <span class="font-extrabold text-sm">Daftar Karyawan</span>
                </a>
            </div>
        </div>

    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('realtime-clock').textContent = `${hours}:${minutes}:${seconds}`;

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('id-ID', options);
            document.getElementById('realtime-date').textContent = dateString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

@endsection
