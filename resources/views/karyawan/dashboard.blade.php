@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm flex flex-col justify-center relative overflow-hidden group">
            <div class="relative z-10 flex items-center gap-6">
                <div class="h-20 w-20 shrink-0 rounded-[1.25rem] bg-violet-50 p-1 border-2 border-violet-100 shadow-sm transition-transform group-hover:scale-105">
                    @if(Auth::user()->foto_profil)
                        <img src="{{ Auth::user()->foto_profil }}" class="h-full w-full rounded-2xl object-cover">
                    @else
                        <div class="h-full w-full rounded-2xl bg-gradient-to-tr from-emerald-500 to-fuchsia-400 flex items-center justify-center text-3xl font-black text-white shadow-inner uppercase border-2 border-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-50 text-emerald-700 text-[10px] font-bold uppercase tracking-wider mb-2 shadow-sm border border-violet-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-violet-500 animate-pulse"></span>
                        Karyawan
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-700 leading-tight mb-1 tracking-tight">{{ Auth::user()->name }}</h1>
                    <p class="text-slate-400 text-sm font-bold font-mono bg-slate-50 px-2 py-0.5 rounded-md inline-block border border-slate-100">{{ Auth::user()->username }}</p>
                </div>
            </div>

            <!-- Soft Emerald Blobs -->
            <div class="absolute right-0 top-0 w-48 h-48 bg-emerald-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -mr-10 -mt-10 group-hover:scale-110 transition-transform duration-700"></div>
            <div class="absolute right-10 bottom-0 w-32 h-32 bg-teal-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -mb-10 group-hover:scale-110 transition-transform duration-700 delay-100"></div>
        </div>

        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2rem] p-6 relative overflow-hidden shadow-2xl shadow-slate-900/20 text-center flex flex-col justify-center min-h-[200px] border border-slate-700">
            <!-- Glow Effects -->
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-violet-500 blur-[80px] opacity-30"></div>
            <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-teal-500 blur-[80px] opacity-30"></div>

            <div class="relative z-10 bg-white/5 border border-white/10 rounded-3xl p-6 backdrop-blur-md">
                <p class="text-emerald-200 text-sm font-bold mb-3 tracking-wide drop-shadow-md" id="widget-date">
                    Memuat Tanggal...
                </p>

                <h2 class="text-5xl md:text-6xl font-black font-mono tracking-tighter text-white drop-shadow-[0_0_15px_rgba(16,185,129,0.5)] mb-3" id="widget-time">
                    --:--:--
                </h2>

                <p class="text-[10px] text-slate-400 font-extrabold uppercase tracking-[0.3em]">
                    Waktu Sistem
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm h-full relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-violet-400 to-fuchsia-500"></div>
                
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-extrabold text-slate-700 text-2xl tracking-tight">Presensi Harian</h3>
                        <p class="text-slate-400 text-sm mt-1 font-medium">Lakukan pencatatan kehadiran masuk & pulang Anda.</p>
                    </div>
                    @if($presensiHariIni)
                        <span class="px-4 py-1.5 bg-violet-50 text-emerald-700 text-xs font-black uppercase tracking-wider rounded-xl border border-violet-200 shadow-sm">
                            Tercatat
                        </span>
                    @else
                        <span class="px-4 py-1.5 bg-slate-50 text-slate-500 text-xs font-black uppercase tracking-wider rounded-xl border border-slate-200 shadow-sm">
                            Menunggu
                        </span>
                    @endif
                </div>

                @if(!$presensiHariIni)
                    <div class="text-center py-10 bg-slate-50 rounded-[2rem] border border-dashed border-slate-300 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-violet-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10">
                            <div class="inline-flex h-20 w-20 items-center justify-center rounded-2xl bg-white text-emerald-500 mb-6 shadow-sm group-hover:scale-110 group-hover:text-violet-500 transition-all duration-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <a href="{{ route('karyawan.presensi.create') }}" class="block max-w-sm mx-auto py-4 bg-violet-500 hover:bg-violet-400 text-white font-bold rounded-2xl shadow-xl shadow-violet-500/30 transition-all transform hover:-translate-y-1">
                                Absen Masuk Sekarang
                            </a>
                        </div>
                    </div>

                @else
                    <div class="grid grid-cols-2 gap-5">
                        <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="absolute right-0 bottom-0 w-20 h-20 bg-emerald-100 rounded-tl-[3rem] opacity-50 group-hover:scale-110 transition-transform"></div>
                            <div class="relative z-10">
                                <p class="text-[11px] text-slate-500 font-bold uppercase tracking-widest mb-2">Jam Masuk</p>
                                <p class="text-3xl font-black font-mono text-slate-700">{{ $presensiHariIni->jam_masuk }}</p>
                                <div class="mt-3 inline-flex items-center gap-1 text-[10px] uppercase font-bold text-violet-500 bg-violet-50 px-2 py-1 rounded-lg">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Terekam
                                </div>
                            </div>
                        </div>

                        <div class="p-6 {{ $presensiHariIni->jam_pulang ? 'bg-slate-50 border-slate-100' : 'bg-amber-50/50 border-amber-100' }} rounded-[2rem] border relative overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="absolute right-0 bottom-0 w-20 h-20 {{ $presensiHariIni->jam_pulang ? 'bg-teal-100' : 'bg-amber-100' }} rounded-tl-[3rem] opacity-50 group-hover:scale-110 transition-transform"></div>
                            <div class="relative z-10">
                                <p class="text-[11px] text-slate-500 font-bold uppercase tracking-widest mb-2">Jam Pulang</p>
                                @if($presensiHariIni->jam_pulang)
                                    <p class="text-3xl font-black font-mono text-slate-700">{{ $presensiHariIni->jam_pulang }}</p>
                                    <div class="mt-3 inline-flex items-center gap-1 text-[10px] uppercase font-bold text-teal-600 bg-teal-50 px-2 py-1 rounded-lg">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Terekam
                                    </div>
                                @else
                                    <h4 class="text-xl font-bold text-amber-700 opacity-60 mb-2 font-mono">--:--:--</h4>
                                    <a href="{{ route('karyawan.presensi.create') }}" class="inline-flex items-center gap-1 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 px-4 py-2 rounded-xl transition-colors shadow-sm shadow-amber-500/20">
                                        Absen Pulang
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <a href="{{ route('karyawan.presensi.riwayat') }}" class="group relative bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 flex items-center justify-between overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-700 text-lg">Riwayat</h4>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Log Bulanan</p>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-colors relative z-10 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </a>

            <a href="{{ route('karyawan.gaji.index') }}" class="group relative bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 flex items-center justify-between overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-violet-50 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-violet-50 text-violet-500 flex items-center justify-center group-hover:scale-105 transition-transform shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-700 text-lg">Slip Gaji</h4>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Penghasilan</p>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-violet-500 group-hover:text-white transition-colors relative z-10 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
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

        const widgetTime = document.getElementById('widget-time');
        if(widgetTime) {
            widgetTime.innerText = `${hours}:${minutes}:${seconds}`;
        }

        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        const widgetDate = document.getElementById('widget-date');
        if(widgetDate) {
            widgetDate.innerText = now.toLocaleDateString('id-ID', options);
        }
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection
